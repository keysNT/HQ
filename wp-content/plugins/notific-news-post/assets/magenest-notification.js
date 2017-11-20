/**
 * Created by hangnt on 23/10/2017.
 */

function notification_seen(post_id) {
    var data = {action : 'remove_news_seen'};
    data['post_id'] = post_id;
    jQuery.get(ajaxurl , data , function(response) {
        var obj = JSON.parse(response);
        //var update = obj.update;
        if (obj.type ='success') {
            console.log(obj);
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
    var data = {action : 'create_notification'};
    var arr = ['Professional Development','Communication Development','Leadership & Managerial Development','Pedagogical Toolbox','Training Family Community'];
    data['title'] = arr;
    jQuery.get(ajaxurl , data , function(response) {
        var obj = JSON.parse(response); console.log(obj);
        var update = obj.update; var a = true;
        if (obj.type ='success') {
            var title_arr = obj.title;
            for(var i = 0; i < title_arr.length; i++){
                if(title_arr[i][2]){
                    jQuery('.menu-box .menu-primary-menu-container .bluebell-primary-menu').find('a').each(function (j) {
                        if(title_arr[i][0] == 'Leadership & Managerial Development'){
                            title_arr[i][0] = 'Leadership &amp; Managerial Development';
                        }
                        if(title_arr[i][0] == jQuery(this).html()){
                            jQuery(this).append("<span id='count_notific'><img src='https://www.bluebellretailacademy.com/wp-content/uploads/2017/11/icon-notification.png' style='width:20px; height:15px;' ></span>");
                            if((j==2 || j==3 || j==4) && a){
                                jQuery('.menu-item-10').find('a').first().append("<span id='count_notific'><img src='https://www.bluebellretailacademy.com/wp-content/uploads/2017/11/icon-notification.png' style='width:20px; height:15px;' ></span>"); a = false;
                            }
                        }
                    });
                }
            }
        }
    });
    if(jQuery('.bb-nav')[0]){
        var data = {action : 'add_highlight'};
        var arr = [];
        var title = jQuery('.container').find('h3').first().html();
        if(title == 'Leadership &amp; Managerial Development'){
            title = 'Leadership & Managerial Development';
        }
        data['title'] = title; console.log(title);
        jQuery.get(ajaxurl , data , function(response) {
            var obj = JSON.parse(response);
            if (obj.type = 'success') {
                console.log('success');
                var links_arr = obj.links;console.log(links_arr);
                jQuery('.bb-nav').find('a').each(function (i) { console.log(i);
                    var link = jQuery(this).attr('href');
                    for(var j=0; j<links_arr.length; j++){
                        var l = link.length;
                        var sub = link.slice(l-1,l); console.log(sub);
                        if(sub != '/'){
                            link += '/';
                        }
                        console.log(links_arr[j]);console.log(link);
                        if(links_arr[j] == link){
                            console.log('sssssss');
                            jQuery(this).attr('class','highlight');
                        }
                    }
                });
            }
        });
        //}
        //if(jQuery('.bluebell-list')[0]){
        console.log('huhuhu');
        var data = {action : 'add_news_icon'};
        var arr = []; var j = 0;
        var title = jQuery('.container').find('h3').first().html();
        if(title == 'Leadership &amp; Managerial Development'){
            title = 'Leadership & Managerial Development';
        }
        data['title'] = title; console.log(title);

        jQuery('.bluebell-list').find('a').each(function (i) {
            var link = jQuery(this).attr('href');
            arr[j] = [link,i,'list']; j++;
        });
        jQuery('.bb-nav').find('a').each(function (i) {
            var link = jQuery(this).attr('href');
            arr[j] = [link,i,'nav']; j++;
        });
        data['link'] = arr;
        jQuery.get(ajaxurl , data , function(response) {
            var obj = JSON.parse(response);
            var update = obj.update;
            if (obj.type ='success') {
                var link_arr = obj.link; console.log('link_arr');console.log(link_arr);
                for(var i = 0; i < link_arr.length; i++){

                    if(link_arr[i][2] == 'nav'){ console.log('nav');
                        jQuery('.bb-nav').find('a').each(function (j) {
                            if(link_arr[i][0] == j){
                                jQuery(this).attr('onclick','notification_seen('+link_arr[i][1]+')');
                                jQuery(this).attr('class','highlight');
                            }
                        });
                    }else{
                        jQuery('.bluebell-list').find('a').each(function (j) {
                            if(link_arr[i][0] == j){
                                jQuery(this).attr('onclick','notification_seen('+link_arr[i][1]+')');
                                jQuery(this).add("<span id='count_notific'><img src='https://www.bluebellretailacademy.com/wp-content/uploads/2017/11/icon-notification.png' style='width:20px; height:15px;'></span>").appendTo(this);// = "<span id='count_notific'>qqqq<img src='#' style='width:20px; height:15px;'></span>";
                            }
                        });
                    }
                }
            }
        });
    }
});