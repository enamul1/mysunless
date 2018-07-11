<?php
namespace App\Controllers\Dashboard;

use Illuminate\Support\Facades\Input;

class VideosController extends BaseDashboardController
{

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('auth');
    }

    public function index()
    {
        $this->requirePermission('edit-videos');
        $videos = \Video::getAllVideos();
        return \View::make('dashboard/videos/index')->with('videos', $videos);
    }

    public function addVideo()
    {
        $this->requirePermission('edit-videos');
        $video_types = \VideoType::lists('name','id');
        return \View::make('dashboard/videos/add',array(
            'notificationMessage' => \Session::get('notificationMessage'),
            'notificationType'    => \Session::get('notificationType'),
        ))->with('video_types',$video_types)->with('pageTitle','Add New Video');
    }

    public function saveVideo()
    {
        $this->requirePermission('edit-videos');
        $input = \Input::all();
        $validator = \Video::validator($input);
        if ($validator->fails()) {
            return \Redirect::back()->withInput($input)->withErrors($validator);
        }
        $id = \Input::get('id');
        if (isset($id)) {
            $data = \Input::except('_token', 'id');
            \Video::where('id', $id)->update($data);
            $notificationMessage = "You have successfully edited the video";
        } else {
            \Video::add($input);
            $notificationMessage = "You have successfully added a new video";
        }

        return \Redirect::back()->with(array('notificationMessage' => $notificationMessage, 'notificationType' => 'success'));
    }

    public function editVideo($id)
    {
        $this->requirePermission('edit-videos');
        $video_types = \VideoType::lists('name','id');
        $video = \Video::getVideoById($id);
        return \View::make('dashboard/videos/add',array(
            'notificationMessage' => \Session::get('notificationMessage'),
            'notificationType'    => \Session::get('notificationType'),
        ))->with('video_types',$video_types)->with('video',$video)->with('pageTitle','Edit Video');

    }

    public function deleteVideo()
    {
        $this->requirePermission('edit-videos');
        if (\Request::ajax()) {
            $id = \Input::get('id');
            $video = \Video::getVideoById($id);

            if ($video instanceof \Video) {
                $video->delete();
            }

            return \Response::json(array('success' => true), 200);
        }
    }

    /**
     * show videos to customer
     *
     * @param string $type
     * @return \Illuminate\View\View
     */
    public function show($type = 'all')
    {
        $this->requirePermission('show-videos');
        $videos = \Video::getlAllVideosByType($type);
        $videoType = \VideoType::getVideoTypeById($type);
        if (empty($videoType)) {
            $videoType = 'All';
        }
        return \View::make('dashboard/videos/show')->with('videos', $videos)->with('videoType', $videoType)->with('videoTypeId', $type);
    }
}
