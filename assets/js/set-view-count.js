/*
 * Set view count (post, page)
 * http://kopatheme.com
 * Copyright (c) 2014 Kopatheme
 *
 * Licensed under the GPL license:
 *  http://www.gnu.org/licenses/gpl.html
 */
jQuery(document).ready(function() {
    if (masterpiece_lite_variable.template.post_id > 0) {
        jQuery.ajax({
            type: 'POST',
            url: masterpiece_lite_variable.url.ajax,
            dataType: 'json',
            async: true,
            timeout: 5000,
            data: {
                action: 'masterpiece_toolkit_set_view_count',
                wpnonce: jQuery('#masterpiece_toolkit_set_view_count_wpnonce').val(),
                post_id: masterpiece_lite_variable.template.post_id
            },
            beforeSend: function(XMLHttpRequest, settings) {
            },
            complete: function(XMLHttpRequest, textStatus) {
            },
            success: function(data) {
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
            }
        });
    }
});