<?php
class Video extends BaseModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'videos';

    /**
     * Soft delete
     *
     * @var bool
     */
    protected $softDelete = true;

    public static $unguarded = true;


    /**
     * validate user input
     *
     * @param array $input
     * @return \Illuminate\Validation\Validator
     */
    public static function validator(array $input)
    {
        $rules = array(
            'source'=>'required|url',
            'title'=>'required|min:3',
            'description'=>'required',
            'video_type_id' => 'required'
        );

        return Validator::make($input, $rules);

    }

    /**
     * add a video
     *
     * @param array $data
     * @return Video
     */
    public static function add(array $data)
    {
        $data = array(
            'source' => $data['source'],
            'video_type_id' => $data['video_type_id'],
            'title' => $data['title'],
            'description' => $data['description'],
        );

        return self::create($data);
    }

    /**
     * get video
     *
     * @param string $id
     * @return Video
     */
    public static function getVideoById($id)
    {
        return self::find($id);

    }
    /**
     * get all videos
     *
     * @return araay
     */
    public static function getAllVideos()
    {
        return self::paginate(10);
    }

    /**
     * get all videos by type
     *
     * @param string $type
     * @return array
     */
    public static function getlAllVideosByType($type = 'all')
    {
        if ($type != 'all') {
            return self::where('video_type_id', $type)->get();
        } else {
            return self::all();
        }
    }

    /**
     * get Youtube video id from url
     *
     * @param string $source
     * @return bool
     */
    public static function getYoutubeVideoIdFromSource($source)
    {
        $video_id = false;
        $url = parse_url($source);
        if (strcasecmp($url['host'], 'youtu.be') === 0)
        {
            #### (dontcare)://youtu.be/<video id>
            $video_id = substr($url['path'], 1);
        }
        elseif (strcasecmp($url['host'], 'www.youtube.com') === 0)
        {
            if (isset($url['query']))
            {
                parse_str($url['query'], $url['query']);
                if (isset($url['query']['v']))
                {
                    #### (dontcare)://www.youtube.com/(dontcare)?v=<video id>
                    $video_id = $url['query']['v'];
                }
            }
            if ($video_id == false)
            {
                $url['path'] = explode('/', substr($url['path'], 1));
                if (in_array($url['path'][0], array('e', 'embed', 'v')))
                {
                    #### (dontcare)://www.youtube.com/(whitelist)/<video id>
                    $video_id = $url['path'][1];
                }
            }
        }
        return $video_id;
    }
}
