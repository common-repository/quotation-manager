<?php
defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );
?>
<div class='qm-settings'>
    <span id='scrollTop'> <a id='chapter_1'></a> <a id='chapter_2'></a> <a id='chapter_3'></a> <a id='chapter_help'></a> <a id='chapter_about'></a></span>
    <br>
    <br>
    <?php 
    $sections = $this->get_all_sections( $this->page );
    $n = 0;
    foreach( $sections as $key){
        if( $n++ != 0)
            echo " | ";
        echo "<a class='cls" . $n . " " . ($n == 1? 'active' : '') . "' href='#chapter_" . $n . "'>";
        echo $key . "</a>";
    }
    ?>
    | <a class='clshelp' href='#chapter_help'><?php echo __( 'Help', QUOTATION_MANAGER_TEXT_DOMAIN ); ?></a>
    | <a class='clsabout' href='#chapter_about'><?php echo __( 'About', QUOTATION_MANAGER_TEXT_DOMAIN ); ?></a>

    <br>
    <div>
        <form method="post" action="options.php">
        
        <input type='hidden' name='page_options' value='<?php echo $this->options_root; ?>'/>

        <?php
            settings_fields( 'options' );
            $c = 0;
            $sections = $this->get_all_sections( $this->page );
            foreach( $sections as $key){
                $c++;
                echo "<div id='id" . $c . "' class='" . ($c != 1? 'hide' : '')  . "'>";
                do_settings_sections( $key . '_admin_' . QUOTATION_MANAGER_TEXT_DOMAIN  );
                submit_button( __( 'Save all changes', QUOTATION_MANAGER_TEXT_DOMAIN ));
                echo "</div>";
            }

            echo "<div id='idhelp' class='hide'>" ;
            echo "<h2>" . __( 'Help ', QUOTATION_MANAGER_TEXT_DOMAIN )  . "</h2>"; 
            echo "<div>";
            echo "<h4>" . __( 'Step 1', QUOTATION_MANAGER_TEXT_DOMAIN ) . "</h4>";
            echo "<p>" . __( 'Start by designing a quotation form with the block editor of WordPress. Choose the form block and add the input fields to the form. 
                In the column to the right of the editor screen under Block settings choose the context sensitive options for the form or the input fields you want.' ) . "</p>";
            echo "</div><div>";
            echo "<h4>" . __( 'Step 2', QUOTATION_MANAGER_TEXT_DOMAIN ) . "</h4>";
            echo "<p>" . __( 'Make sure all fields have a unique name for the form and save the post or page.' ) . "</p>";
            echo "</div>";
            echo "</div>";

            echo "<div id='idabout' class='hide'>"; 
            echo "<div id='logo'><img height='128px' src='" . plugin_dir_url( QUOTATION_MANAGER__PLUGIN_FILE ) . "/img/ballon.svg'/></div>";
            echo "<h2>" . __( 'About me ' )  . "</h2><p>"; 
            echo __( 'Thank you for choosing Quotation Manager!<br><br>You can contact me on Facebook. Please visit 
                <a href="https://facebook.com/quotationmanager">facebook.com/quotationmanager</a>. <br/><br>', QUOTATION_MANAGER_TEXT_DOMAIN );
            echo '<br><br>';
            //echo '<b>' . __( 'Currently installed version : ' ), get_plugin_data( TEXT_DOMAIN )['Version'] . '</b>';
            echo "</p></div>";
        ?>
        </form>
    </div>
</div>