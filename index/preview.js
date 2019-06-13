var hotvideos = document.getElementById('hotvideos');
var vidcount;
var page1;
var link1=[];
link1.push(link_0);
link1.push(link_1);
link1.push(link_2);
link1.push(link_3);
link1.push(link_4);
link1.push(link_5);
link1.push(link_6);
link1.push(link_7);
link1.push(link_8);
link1.push(link_9);
var title1=[];
title1.push(title_0);
title1.push(title_1);
title1.push(title_2);
title1.push(title_3);
title1.push(title_4);
title1.push(title_5);
title1.push(title_6);
title1.push(title_7);
title1.push(title_8);
title1.push(title_9);
var id1=[];
id1.push(id_0);
id1.push(id_1);
id1.push(id_2);
id1.push(id_3);
id1.push(id_4);
id1.push(id_5);
id1.push(id_6);
id1.push(id_7);
id1.push(id_8);
id1.push(id_9);
var length1=[];
length1.push(length_0);
length1.push(length_1);
length1.push(length_2);
length1.push(length_3);
length1.push(length_4);
length1.push(length_5);
length1.push(length_6);
length1.push(length_7);
length1.push(length_8);
length1.push(length_9);
var imgpath1=[];
imgpath1.push(imgpath_0);
imgpath1.push(imgpath_1);
imgpath1.push(imgpath_2);
imgpath1.push(imgpath_3);
imgpath1.push(imgpath_4);
imgpath1.push(imgpath_5);
imgpath1.push(imgpath_6);
imgpath1.push(imgpath_7);
imgpath1.push(imgpath_8);
imgpath1.push(imgpath_9);
var view1=[];
view1.push(view_0);
view1.push(view_1);
view1.push(view_2);
view1.push(view_3);
view1.push(view_4);
view1.push(view_5);
view1.push(view_6);
view1.push(view_7);
view1.push(view_8);
view1.push(view_9);
//var link="corn1.mp4";
if(typeof page=== 'undefined')
{
  page1=1;
}
else {
  page1=page;
}
vidcount=0;
var nowpic;
var previewvid;
for(i=0;i<2;i++)
{
  var newtr = document.createElement('tr');
  for(i1=0;i1<5;i1++)
  {
    var newtd = document.createElement('td');
    var vidpic = document.createElement('img');
    vidpic.id=id1[vidcount];
    vidpic.setAttribute("src",imgpath1[vidcount]);
    vidpic.setAttribute("title",vidcount);
    vidpic.setAttribute("height",200);
    vidpic.setAttribute("width",300);
    vidpic.setAttribute("onmouseover",'mouseOver()');
    newtd.style.cssText="height: 240px;width: 300px; color: white";
    newtd.appendChild(vidpic);
    newtd.innerHTML+=title1[vidcount];
    newtd.innerHTML+="<br>";
    newtd.innerHTML+="("+Math.floor(length1[vidcount]/60)+":"+("0"+Math.round(length1[vidcount]%60)).slice(-2)+")";
    newtd.innerHTML+="---"+view1[vidcount]+" "+"views";
    if(title1[vidcount]=="no such video")
    {
      newtd.innerHTML="";
    }
    newtr.appendChild(newtd);
    vidcount+=1;
  }
  hotvideos.appendChild(newtr);
}

if(page1>3)
{
  var newpage=document.createElement('a');
  newpage.setAttribute("style","color: white;font-size:30px");
  newpage.innerHTML=1+'.....';
  newpage.href="https://softwarestudio.2y.idv.tw/~cornhub/index/index.php";
  document.getElementById("pages").appendChild(newpage);
}
for(i=0;i<5;i++)
{
  var newpage=document.createElement('a');
  newpage.innerHTML=(page1-2+i)+'.';
  if(page1==page1-2+i)
  {
    newpage.setAttribute("style","color: orange;font-size:30px");
  }
  else {
    newpage.setAttribute("style","color: white;font-size:30px");
  }

  newpage.href="https://softwarestudio.2y.idv.tw/~cornhub/index/index.php?page="+(page1-2+i);
  if(page1-2+i>0&&page1-2+i<101)
  {
    document.getElementById("pages").appendChild(newpage);
  }
}
if(page1<98)
{
  var newpage=document.createElement('a');
  newpage.setAttribute("style","color: white;font-size:30px");
  newpage.innerHTML='.....'+100;
  newpage.href="https://softwarestudio.2y.idv.tw/~cornhub/index/index.php?page=100";
  document.getElementById("pages").appendChild(newpage);
}

function mouseOver()
{
  var x = event.clientX; y = event.clientY;
  nowpic = document.elementFromPoint(x, y);
  var rect=nowpic.getBoundingClientRect();
  var playtime=10;
  var myEle = document.getElementById("previewvid");
    if(myEle  != null){
      previewvid.remove();
  }

  previewvid=document.createElement('video');
  previewvid.id="previewvid";
  //previewvid.class="video-js";
  //previewvid.setAttribute("data-setup",'{ "autoplay": true, "controls": true, "poster": "", "preload": "auto"}');
  //previewvid.dataSetup='{ "autoplay": true, "controls": false, "poster": "", "preload": "auto"}'
  previewvid.setAttribute("src",link1[nowpic.title]+"#t="+length1[nowpic.title]/2+","+(length1[nowpic.title]/2+5));
  previewvid.setAttribute("onclick",'location.href="https://softwarestudio.2y.idv.tw/~cornhub/play/viewvideo.php?id="+nowpic.id');
  previewvid.muted=true;
  previewvid.setAttribute("autoplay","true");
  previewvid.setAttribute("height",200);
  previewvid.setAttribute("width",300);
  previewvid.setAttribute("onmouseout",'mouseOut()');
  previewvid.style.position="absolute";
  previewvid.style.top=rect.top+"px";
  previewvid.style.left=rect.left+"px";
  previewvid.style.zIndex=1;
  //previewvid.currentTime=50;
  document.getElementById('upper').appendChild(previewvid);
}
function mouseOut()
{
  previewvid.remove();
}
