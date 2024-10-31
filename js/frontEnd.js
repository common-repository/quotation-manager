(function(){

    document.addEventListener( 'DOMContentLoaded', () => {
        var inps = document.querySelectorAll( 'form[name=qm_quotation_form] input[name=nonce]' )

        if( inps){
            
            inps.forEach( ( inp ) => {
                inp.setAttribute( 'value', nonce );
                inp.value = nonce
            })
        }
        document.querySelector( '.button' ).classList.add( 'visible' )
    } )
})()