<?php 
/**
 * Logic for displaying pulling in the appropriate featured video from meta post_options
 */
$options = get_post_meta( get_the_ID(), 'post_options', true);
if (isset($options['featured_video'])){
    $vid = $options['featured_video'];
    if ($vid !='') {
        if (strpos($vid, 'youtube') !== false){
            $val = explode('v=', $vid);
            $vid_img = 'https://img.youtube.com/vi/'.$val[1].'/maxresdefault.jpg';
            $vid_embed = 'https://www.youtube.com/embed/'.$val[1].'?rel=0&amp;showinfo=0';
        }elseif(strpos($vid, 'youtu.be') !== false){
            $val = explode('/', $vid);
            $vid_img = 'https://img.youtube.com/vi/'.$val[3].'/maxresdefault.jpg';
            $vid_embed = 'https://www.youtube.com/embed/'.$val[3].'?rel=0&amp;showinfo=0';
        }else{
            $val = substr($vid, strrpos($vid, '/') + 1);
            $hash = unserialize(file_get_contents("https://vimeo.com/api/v2/video/$val.php"));
            $vid_img = $hash[0]['thumbnail_large']; 
            $vid_embed = 'https://player.vimeo.com/video/'.$val.'?title=0&byline=0&portrait=0';
        }
        $plybtn = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iMjRweCIgaGVpZ2h0PSIzMXB4IiB2aWV3Qm94PSIwIDAgMjQgMzEiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgICA8IS0tIEdlbmVyYXRvcjogU2tldGNoIDYxLjIgKDg5NjUzKSAtIGh0dHBzOi8vc2tldGNoLmNvbSAtLT4KICAgIDx0aXRsZT5TbGljZSAxPC90aXRsZT4KICAgIDxkZXNjPkNyZWF0ZWQgd2l0aCBTa2V0Y2guPC9kZXNjPgogICAgPGcgaWQ9IlBhZ2UtMSIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBvbHlnb24gaWQ9IlBhdGgiIGZpbGw9IiNGRkZGRkYiIHBvaW50cz0iMCAzMC4wNzU5NDk0IDI0IDE1LjE4OTg3MzQgMCAwIj48L3BvbHlnb24+CiAgICA8L2c+Cjwvc3ZnPg==';
    }else{
    }
}else{
    $vid = '';
}
    
    