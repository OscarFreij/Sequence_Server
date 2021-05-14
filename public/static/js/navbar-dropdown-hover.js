var $dropdown = $(".dropdown");
var $dropdownToggle = $(".dropdown-toggle");
var $dropdownMenu = $(".dropdown-menu");
const showClass = "show";
 
$(window).on("load resize", function() {

    $dropdown = $(".dropdown");
    $dropdownToggle = $(".dropdown-toggle");
    $dropdownMenu = $(".dropdown-menu");

  if (this.matchMedia("(min-width: 768px)").matches) {
    $dropdown.hover(
      function() {
        const $this = $(this);
        $this.addClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "true");
        $this.find($dropdownMenu).addClass(showClass);
      },
      function() {
        const $this = $(this);
        $this.removeClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "false");
        $this.find($dropdownMenu).removeClass(showClass);
      }
    );
  } else {
    $dropdown.off("mouseenter mouseleave");
  }
});