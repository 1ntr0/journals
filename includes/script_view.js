document.onkeydown = handle;

link = 'view.php?id='+id+'&page=';

function handle(e)
{
    if (e.keyCode==35) location.replace (link+kolvo); 	//end
    if (e.keyCode==36) location.replace (link+'1');	// home
    if (e.keyCode==37) location.replace (link+nalevo);		// left arrow
    if (e.keyCode==39) location.replace (link+napravo);		// right arrow
}
