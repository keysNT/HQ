/**
 * Created by magenest4 on 31/08/2017.
 */
function notification_seen(post_id) {
    var data = {action : 'remove_news_seen'};
    data['post_id'] = post_id;
    jQuery.get(ajaxurl , data , function(response) {
        var obj = JSON.parse(response);
        //var update = obj.update;
        if (obj.type ='success') {
            // // count_notific
            // var x = parseInt(jQuery('#count_notific').html());
            // var y = x-1;
            // jQuery('#count_notific').html(y);
            // var id = '#'+obj.id;
            // window.location.href = jQuery(id).html();
        } else {
            alert(obj.message);
        }
    });
}

setInterval(my_click,500);
function my_click() {
    jQuery('a.ap-q-link').each(function (i) {
        var link = jQuery(this).attr("href");
        var p = link.indexOf('?p=');
        var l = link.length;
        if(p>0){
            var page = link.slice(p+3,l);
            jQuery(this).attr("id",page);
            var links = "remove_notific_seen("+page+")";
            jQuery(this).attr('href','#');
            jQuery(this).attr("onclick",links);
        }
    });
}
function remove_notific_seen(post_id) {
    var b = "https://www.bluebellretailacademy.com/?p="+post_id;
    var id = "#"+post_id;
    var c = jQuery(id).parent().parent().attr('class');
    //ap-notification-item
    var n = c.search('ap-notification-item');
    var m = c.substring(0,n);
    var p = m.replace('ap-notification-','');
    console.log('post_id');

    console.log(p);
    console.log(m);
    var d = "."+m;
    var arr_data = {action : 'remove_notific_seen'};
    arr_data['post_id'] = p;
    jQuery.get(ajaxurl , arr_data , function(response) {
        window.location.href = b;
    });
}

jQuery(document).ready(function(){
    var data = {action : 'add_news_icon'};
    var arr = [];
    console.log('ahihi');//var blue_list =
    jQuery('.bluebell-list').find('a').each(function (i) {
        var link = jQuery(this).attr('href');
        arr[i] = [link,i];
        console.log(link);
    });
    data['link'] = arr;
    console.log('bhihi');
    jQuery.get(ajaxurl , data , function(response) {
        var obj = JSON.parse(response);
        var update = obj.update;
        if (obj.type ='success') {
            var link_arr = obj.link;
            for(var i = 0; i < link_arr.length; i++){
                jQuery('.bluebell-list').find('a').each(function (j) {
                    console.log('AAAA');
                    if(link_arr[i][0] == j){
                        jQuery(this).attr('onclick','notification_seen('+link_arr[i][1]+')');
                        console.log(link_arr[i]);
                        jQuery(this).add("<span id='count_notific'><img src='http://localhost/wooc/bb.seoulmage.com/wp-content/plugins/notific-news-post/assets/icon notification.png' style='width:20px; height:15px;'></span>").appendTo(this);// = "<span id='count_notific'>qqqq<img src='#' style='width:20px; height:15px;'></span>";
                    }
                });
            }
        }
    });
    //console.log(data);
});


