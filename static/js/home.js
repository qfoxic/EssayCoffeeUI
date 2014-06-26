$( document ).ready( function( ) {
    // $( '.carousel' ).carousel( );
    $( '.duration' ).selectpicker( {
        width: '65%'
    } );
    $( '.price_holder' ).on( 'mouseenter', function( ev ) {
        $( this ).addClass( 'price_holder_hi' );
        $( this ).find( 'p.title, a.btn' ).each( function( ) {
            $( this ).addClass( 'bg_hi' );
        } );
    } );
    $( '.price_holder' ).on( 'mouseleave', function( ev ) {
        $( this ).removeClass( 'price_holder_hi' );
        $( this ).find( 'p.title, a.btn' ).each( function( ) {
            $( this ).removeClass( 'bg_hi' );
        } );
    } );
} );
