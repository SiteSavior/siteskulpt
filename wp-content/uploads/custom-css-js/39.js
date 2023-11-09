<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
/* Default comment here */ 
window.onload = function() {
  var splineElement = document.querySelectorAll('spline-viewer');
  
  for (let pas = 0; pas < splineElement.length; pas++) {
    var shadowRoot = splineElement[pas].shadowRoot;
    shadowRoot.querySelector('#logo').remove();
  }
}

</script>
<!-- end Simple Custom CSS and JS -->
