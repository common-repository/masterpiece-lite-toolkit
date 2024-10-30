<?php

function masterpiece_toolkit_metabox_field_quote($html, $wrap_start, $wrap_end, $field, $value){
    ob_start();

    $value = wp_parse_args((array) $value, array('quote'=> NULL, 'author' => NULL));
    extract($value );   

    echo sprintf( '%s', $wrap_start );      
    ?>  
    <div class="mp-clearfix">        
        <p class="mp-block mp-block-first">
            <code class="mp-code mp-pull-left"><?php esc_html_e('Message:', 'masterpiece-lite-toolkit'); ?></code>
            <br/>
            <textarea 
                name="<?php echo esc_attr($field['id']);?>[quote]" 
                id="<?php echo esc_attr($field['id']);?>_quote" 
                value="<?php echo esc_attr($quote);?>" 
                autocomplete="off"
                class="large-text"/><?php echo esc_textarea($quote); ?></textarea>
        </p>
        <p class="mp-block">            
            <code class="mp-code mp-pull-left"><?php esc_html_e('Author:', 'masterpiece-lite-toolkit'); ?></code>
            <br/>
            <input type="text"mp
                name="<?php echo esc_attr($field['id']);?>[author]" 
                id="<?php echo esc_attr($field['id']);?>_author" 
                value="<?php echo esc_attr($author);?>" 
                autocomplete="off"
                class="mp-pull-left medium-text"/>            
        </p>                
    </div>      
    <?php
    echo sprintf( '%s', $wrap_end );
    $html = ob_get_clean();

    return $html;
}