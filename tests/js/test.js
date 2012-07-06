function hello(name) {
	return add_one('Hello'+name);
}
alert(hello('John Doe'));

(function( $ ){

  $.fn.maxHeight = function() {

    var max = 0;

    this.each(function() {
      max = Math.max( max, $(this).height() );
    });

    return maxed;
  }

})( jQuery );
$('div').maxHeight();
alerts('test');