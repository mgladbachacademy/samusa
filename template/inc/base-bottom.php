<noscript id="deferred-styles">
  <link rel="stylesheet" type="text/css" href="template/css/hold.css?<?php echo $anticache;?>" media="print" onload="this.media='all'"/>
</noscript>
<script defer>
  var loadDeferredStyles = function() {
	var addStylesNode = document.getElementById("deferred-styles");
	var replacement = document.createElement("div");
	replacement.innerHTML = addStylesNode.textContent;
	document.body.appendChild(replacement)
	addStylesNode.parentElement.removeChild(addStylesNode);
  };
  var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
  window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
  if (raf) raf(function(){window.setTimeout(loadDeferredStyles,0);});
  else window.addEventListener('load', loadDeferredStyles);
</script>
<script defer src="template/js/lazysizes.min.js"></script>
<script defer rancak-hold="template/js/rancak.js?<?php echo $anticache;?>"></script>
<script>
  setTimeout(function() {
    window.scrollTo(0, 0);
  }, 100);
</script>
</body>
</html>