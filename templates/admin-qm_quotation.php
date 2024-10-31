<?php 
    defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );

    $postId = $_GET[ 'post' ];
    if( intval( $postId ) > 0){
        $postFormId = get_post_meta( $postId, 'wp_postID', true );
        $metas = get_post_meta( $postId );
        ksort( $metas );
        $postMeta = json_encode( $metas );

        $q = new WP_Query( array( "p" => $postFormId ));
    
        if( $q->have_posts() && $q->posts[0]->ID == $postFormId){
            $q->the_post();
            get_template_part( 'template-parts/content', 'post' );
        }
        $root = get_site_url();
    }
?>
<script type='text/javascript'>
var metas = <?php echo $postMeta ;?>;
var url = '<?php echo $root ;?>';

function addRow( rowId ){
    var row = document.querySelector( '[kind=rows][rel=' + rowId + '] fieldset[name=row]' ),
        parent = row.parentNode,
        newRow = row.cloneNode( true );

    var sps = newRow.querySelectorAll('span');
    sps.forEach( ( s ) => {
        s.remove()
    })

    var inps = newRow.querySelectorAll( 'input' ),
        selects = newRow.querySelectorAll( 'select' ),
        rowNbr = row.parentNode.querySelectorAll( '.wp-block-quotation-manager-row' ).length + 1;

    inps.forEach( ( inp ) => {
        var name = inp.getAttribute( 'name' )
        inp.setAttribute( 'name',  name + rowNbr )
        inp.setAttribute( 'value', '' )
        inp.value = ''
        inp.removeAttribute( 'selected' )
    })

    selects.forEach( ( sel ) => {
        var name = sel.getAttribute( 'name' ),
            name1 = name.substring( 0, name.length - 2),
            options = sel.querySelectorAll( 'option' );

        sel.setAttribute( 'name',  name1 + rowNbr + '[]')
        sel.setAttribute( 'value', '' )
        options.forEach( ( option ) => {
            option.removeAttribute( 'selected' )
        })
    })

    parent.appendChild( newRow )
    
}

function fillField( meta, retry ){
    if( meta.match(/_checkbox_input\d*$/)){
        if( metas[meta][0] == 'on'){
            var ob = document.querySelector( '[name="' + meta + '"]')
            if( ob )
                ob.checked = true
            else if( retry ) tryNextRow( meta )
        }
    }
    else if( meta.match(/_radio_input\d*$/)){
        var ob = document.querySelector('[name="' + meta + '"][value="' + metas[ meta ][0] + '"]')
        if( ob )
            ob.checked = true
    }
    else if( meta.match(/_select_input\d*$/)){
        var q = metas[ meta ][0].split( '|' )
        q.forEach( ( m ) => {
            var ob = document.querySelector('select[name="' + meta + '\\[\\]" ] option[value="' + m + '"]' )
            if( ob )
                ob.selected = true
            else if( retry ) tryNextRow( meta )
        })
    }
    else if( meta.match( /_file_input\d*$/ )){

        var q = metas[ meta ][0].split( '|'),
            field = document.querySelector( 'input[name=' + meta + '\\[\\]]' ),
            appendTo = field.parentElement

        q.forEach( ( file ) => {
            var parts = file.split( '/' )

            if( parts.length == 2){
                var el = document.createElement( 'a' )
                
                el.setAttribute( 'href', url + '?getUploadedFile&file=' + parts[ 0 ] )
                el.innerHTML = parts[ 1 ]
                el.setAttribute( 'target', '_blank' )
                
                if(field)
                    field.remove()
                
                appendTo.appendChild( el )
                appendTo.appendChild( document.createElement( 'br' ))
            }
        })
    }
    else{
        var ob = document.querySelector( '[name=' + meta + ']')
        if( ob ){
            ob.value = metas[ meta ][0]
        }
        else if(retry) tryNextRow( meta )
    }
}

function fillForm( retry ){
    for( meta in metas ){

        fillField( meta, true )
    }
}

function tryNextRow( el ){
    var isRowEl = el.match( /^_row/ ),
        rowId = '';

    if( isRowEl && ( el.match( /\d$/ ) || el.match( /\d\\[\\]$/ ))){
        rowId = 'row' + el[4]
        addRow( rowId )
        fillField( el, false )
    }
}

document.addEventListener( 'DOMContentLoaded', () => {
    var del = ['nonce', 'action' ]
    del.forEach( ( name ) => {
        var el = document.querySelector( '.wp-block-quotation-manager-form  input[name=' + name + ']' )
        if( el )
            el.remove()
        else
            console.log( name )
    })
    //var el = document.querySelector( '.wp-block-quotation-manager-form  input[name=action]' ) 
    //el.value = 'edit_quotation'

    fillForm( true )
} )
</script>

<?php
/*        $meta = get_post_meta( $_GET[ 'post' ], 'price', true );

        var_dump( $meta );

        //foreach( $metas as $key => $value ){
            //if( ! preg_match( "/^[_]/", $key ) )
                echo "<div class='qm-row'><div><label>" . ucfirst( 'price' ) . " : </label></div><div><textarea name='price'>" . esc_html( $meta ) . "</textarea></div></div>"; 
        //}

        submit_button();
*/

submit_button();
?>