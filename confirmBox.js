
    function dlgHide(){
        var whitebg = document.getElementById("popupb2");
        var dlg = document.getElementById("dlgbox");
        whitebg.style.display = "none";
        dlg.style.display = "none";
    }

    function showDialog(){
        var whitebg = document.getElementById("popupb2");
        var dlg = document.getElementById("dlgbox");
        whitebg.style.display = "block";
        dlg.style.display = "block";
		
        var winWidth = window.innerWidth;
		
        dlg.style.left = (winWidth/2) - 480/2 + "px";
		
		var winHeight = window.innerHeight;
		
        dlg.style.top = (winHeight/2) - 200/2 + "px";
		alert(winHeight);
    }