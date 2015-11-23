jQuery(document).ready(function () {
  $("button.KhoiTaoMap").click(function(){
    {
           address = $("input[name=address]").val();
           initialize();
           activeEventClickGoogleMap();
           $("label").html( address );
    }
  });
});