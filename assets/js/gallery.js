var MP_Gallery, masterpiece_toolkit_gallery, masterpiece_toolkit_gallery_button;

jQuery(document).ready(function() {
  MP_Gallery.init();
});

jQuery(document).ajaxSuccess(function() {
  MP_Gallery.init();
});

masterpiece_toolkit_gallery = '';

masterpiece_toolkit_gallery_button = '';

MP_Gallery = {
  init: function() {
    jQuery('.mp-gallery-box').on('click', '.mp-gallery-config', function(event) {
      event.preventDefault();
      masterpiece_toolkit_gallery_button = jQuery(this);
      if (masterpiece_toolkit_gallery) {
        masterpiece_toolkit_gallery.open();
        return;
      }
      masterpiece_toolkit_gallery = wp.media.frames.masterpiece_toolkit_gallery = wp.media({
        title: 'Gallery config',
        button: {
          text: 'Use'
        },
        library: {
          type: 'image'
        },
        multiple: true
      });
      masterpiece_toolkit_gallery.on('open', function() {
        var ids, selection;
        ids = masterpiece_toolkit_gallery_button.parents('.mp-gallery-box').find('input.mp-gallery').val();
        if ('' !== ids) {
          selection = masterpiece_toolkit_gallery.state().get('selection');
          ids = ids.split(',');
          jQuery(ids).each(function(index, element) {
            var attachment;
            attachment = wp.media.attachment(element);
            attachment.fetch();
            selection.add(attachment ? [attachment] : []);
          });
        }
      });
      masterpiece_toolkit_gallery.on('select', function() {
        var result, selection;
        result = [];
        selection = masterpiece_toolkit_gallery.state().get('selection');
        selection.map(function(attachment) {
          attachment = attachment.toJSON();
          return result.push(attachment.id);
        });
        if (result.length > 0) {
          result = result.join(',');
          masterpiece_toolkit_gallery_button.parents('.mp-gallery-box').find('input.mp-gallery').val(result);
        }
      });
      masterpiece_toolkit_gallery.open();
    });
  }
};
