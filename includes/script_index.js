document.onkeydown = handle;

if (x==0)
	link = 'index.php?page=';
if (x==1)
	link = 'index.php?category='+category+'&page=';
if (x==2)
	link = 'index.php?category='+category+'&name='+name+'&page=';
if (x==3)
	link = 'index.php?category='+category+'&name='+name+'&year='+year+'&page=';

function handle(e)
{
    if (e.keyCode==35) location.replace (link+count); 		//end
    if (e.keyCode==36) location.replace (link+'0');	// home
    if (e.keyCode==37) location.replace (link+nalevo);		// left arrow
    if (e.keyCode==39) location.replace (link+napravo);		// right arrow
}
