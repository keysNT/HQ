/**
 * Created by hangnt on 23/10/2017.
 */
jQuery(document).ready(function(){
    console.log('aaa');
    var data = {action : 'create_notification'};
    var arr = [];
    jQuery('.menu-box .menu-primary-menu-container .bluebell-primary-menu').find('a').each(function (i) {
        var title = jQuery(this).html();
        //console.log(title);
        arr[i] = [title,i];
    });
    data['title'] = arr;
    jQuery.get(ajaxurl , data , function(response) {
        var obj = JSON.parse(response);
        var update = obj.update;
        if (obj.type ='success') {
            var title_arr = obj.title;
            //<span id='count_notific'><img src='".NOTIFICNEWS_URL."/assets/icon notification.png' style='width:20px; height:15px;' ></span>
            //var lenght = obj.title.length;
            //console.log(lenght);
            for(var i = 0; i < title_arr.length; i++){
                jQuery('.menu-box .menu-primary-menu-container .bluebell-primary-menu').find('a').each(function (j) {
                    if(title_arr[i][0] == jQuery(this).html()){
                        jQuery(this).append("<span id='count_notific'><img src='https://www.bluebellretailacademy.com/wp-content/uploads/2017/10/n.png' style='width:20px; height:15px;' ></span>");
                        console.log(jQuery(this).html());
                        // if(window.location == window.location.hostname){
                        //     alert('1');
                        // }else {
                        //     alert('2');
                        // }
                    }
                });
            }
           // console.log(obj.title);
        }
    });
});
