( function ( $ ) {
      // alert( 'this is demo' );
      function tpgAjaxCall( element, action, arg, handle ) {
            var data;
            if ( action ) data = "action=" + action;
            if ( arg ) data = arg + "&action=" + action;
            if ( arg && !action ) data = arg;

            var n = data.search( rttpg.nonceID );
            if ( n < 0 ) {
                  data = data + "&rttpg_nonce=" + rttpg.nonce;
            }
            console.log( data );
            $.ajax( {
                  type: "post",
                  url: rttpg.ajaxurl,
                  data: data,
                  beforeSend: function () {
                        $( "<span class='rt-loading'></span>" ).insertAfter( element );
                  },
                  success: function ( data ) {
                        element.next( ".rt-loading" ).remove();
                        handle( data );
                  },
                  error: function ( e ) {
                        element.next( ".rt-loading" ).remove();
                  }
            } );
      }

      $( "#rt-tpg-settings-form" ).on( 'click', '.rtSaveButton', function ( e ) {
            e.preventDefault();
            var arg = $( "#rt-tpg-settings-form" ).serialize();
            var bindElement = $( '.rtSaveButton' );
            tpgAjaxCall( bindElement, 'rtTPGSettings', arg, function ( data ) {
                  if ( data.error ) {
                        $( '.rt-response' ).addClass( 'error' );
                        $( '.rt-response' ).show( 'slow' ).text( data.msg );
                  } else {
                        $( '.rt-response' ).addClass( 'updated' );
                        $( '.rt-response' ).removeClass( 'error' );
                        $( '.rt-response' ).show( 'slow' ).text( data.msg );
                  }
            } );
      } );
} )( jQuery );
