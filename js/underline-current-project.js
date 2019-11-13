/**
 * File underline-current-project.js.
 *
 * Underlines current project in sidebar pf Project pages
 *
 */
( function( $ ) {
  $(document).ready(function(){
    var title = $('h3.entry-title').html();
    $(`.widget a:contains(${title})`).parent().css('border-bottom', '1px solid #FDC345');
  });
} )( jQuery );
