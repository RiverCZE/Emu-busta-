$(function(){
  $('#DevTool').dialog({
    autoOpen: false,
    width: 900
  });
});

function DevTool(pagina)
{
  $('#DevTool').dialog('open');
  
  var xhr=null;
  if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
  else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
  xhr.onreadystatechange=function()
  {
    if(xhr.readyState==4)
      document.getElementById('DevTool').innerHTML=xhr.responseText;
    
      $('#date').datepicker({
        dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
        showAnim : 'fadeIn',
        dateFormat: 'yy-mm-dd',
        showOn: 'button'
      });
  }
  xhr.open("GET","admin/admin.php?pagina=" + pagina,true);
  xhr.send(null);
}

function DevForm_AddBan(ip, expire, life, raison)
{
  var xhr;
  if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
  else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
  xhr.open('POST',"admin/admin.php?pagina=bannissement&action=add",true);
  xhr.onreadystatechange = function()
  {
      if (xhr.readyState == 4)
      {
          if (document.getElementById)
          {
              if (xhr.responseText =='true') { /* OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }else{                             /* PAS OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }
          }
      }
  }
  xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  xhr.send('ip='+ip+'&expire='+expire+'&life='+life+'&raison='+raison);
}

function DevForm_TrieAcc(by, order, limit)
{
  var xhr;
  if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
  else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
  xhr.open('POST',"admin/admin.php?pagina=membre",true);
  xhr.onreadystatechange = function()
  {
      if (xhr.readyState == 4)
      {
          if (document.getElementById)
          {
              if (xhr.responseText =='true') { /* OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }else{                             /* PAS OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }
          }
      }
  }
  xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  xhr.send('by='+by+'&order='+order+'&limit='+limit);
}

function DevForm_EditAcc(guid, account, pseudo, email, level, vip, banned, points)
{
  var xhr;
  if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
  else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
  xhr.open('POST',"admin/admin.php?pagina=membre&action=send",true);
  xhr.onreadystatechange = function()
  {
      if (xhr.readyState == 4)
      {
          if (document.getElementById)
          {
              if (xhr.responseText =='true') { /* OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }else{                             /* PAS OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }
          }
      }
  }
  xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  xhr.send('guid='+guid+'&account='+account+'&pseudo='+pseudo+'&email='+email+'&level='+level+'&vip='+vip+'&banned='+banned+'&points='+points);
}

function DevForm_AddNews(title, content, com)
{
  var xhr;
  if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
  else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
  xhr.open('POST',"admin/admin.php?pagina=news&action=add_send",true);
  xhr.onreadystatechange = function()
  {
      if (xhr.readyState == 4)
      {
          if (document.getElementById)
          {
              if (xhr.responseText =='true') { /* OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }else{                             /* PAS OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }
          }
      }
  }
  xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  xhr.send('title='+title+'&content='+content+'&com='+com);
}

function DevForm_EditNews(id, title, content, com)
{
  var xhr;
  if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
  else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
  xhr.open('POST',"admin/admin.php?pagina=news&action=edit_send",true);
  xhr.onreadystatechange = function()
  {
      if (xhr.readyState == 4)
      {
          if (document.getElementById)
          {
              if (xhr.responseText =='true') { /* OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }else{                             /* PAS OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }
          }
      }
  }
  xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  xhr.send('id='+id+'&title='+title+'&content='+content+'&com='+com);
}

function DevForm_Config(mantenimiento, m_raison, construct, c_time, rpg_link, points, puntos_vip, puntos_voto, register, beta)
{
  var xhr;
  if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
  else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
  xhr.open('POST',"admin/admin.php?pagina=config&action=edit",true);
  xhr.onreadystatechange = function()
  {
      if (xhr.readyState == 4)
      {
          if (document.getElementById)
          {
              if (xhr.responseText =='true') { /* OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }else{                             /* PAS OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }
          }
      }
  }
  xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  xhr.send('mantenimiento='+mantenimiento+'&m_raison='+m_raison+'&construct='+construct+'&c_time='+c_time+'&rpg_link='+rpg_link+'&points='+points+'&puntos_vip='+puntos_vip+'&puntos_voto='+puntos_voto+'&register='+register+'&beta='+beta);
}

function DevForm_EditShop(id, name, type, item, level, picture, effets, condi, desc, quant, price, reduc)
{
  var xhr;
  if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
  else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
  xhr.open('POST',"admin/admin.php?pagina=boutique&action=edit_send",true);
  xhr.onreadystatechange = function()
  {
      if (xhr.readyState == 4)
      {
          if (document.getElementById)
          {
              if (xhr.responseText =='true') { /* OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }else{                             /* PAS OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }
          }
      }
  }
  xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  xhr.send('id='+id+'&name='+name+'&type='+type+'&item='+item+'&level='+level+'&picture='+picture+'&effets='+effets+'&condi='+condi+'&desc='+desc+'&quant='+quant+'&price='+price+'&reduc='+reduc);
}

function DevForm_AddShop(name, type, item, level, picture, effets, condi, desc, quant, price, reduc)
{
  var xhr;
  if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
  else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
  xhr.open('POST',"admin/admin.php?pagina=boutique&action=add_send",true);
  xhr.onreadystatechange = function()
  {
      if (xhr.readyState == 4)
      {
          if (document.getElementById)
          {
              if (xhr.responseText =='true') { /* OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }else{                             /* PAS OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }
          }
      }
  }
  xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  xhr.send('name='+name+'&type='+type+'&item='+item+'&level='+level+'&picture='+picture+'&effets='+effets+'&condi='+condi+'&desc='+desc+'&quant='+quant+'&price='+price+'&reduc='+reduc);
}

function DevForm_Search(pagina, search, where)
{
  var xhr;
  if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
  else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
  xhr.open('POST',"admin/admin.php?pagina="+pagina+"",true);
  xhr.onreadystatechange = function()
  {
      if (xhr.readyState == 4)
      {
          if (document.getElementById)
          {
              if (xhr.responseText =='true') { /* OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }else{                             /* PAS OK */
                    document.getElementById('result').innerHTML=''+xhr.responseText+'';
              }
          }
      }
  }
  xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  xhr.send('search='+search+'&where='+where);
}

function WebDebugGetElementsByClassName(strClass, strTag, objContElm)
{
  strTag = strTag || "*";
  objContElm = objContElm || document;
  var objColl = (strTag == '*' && document.all) ? document.all : objContElm.getElementsByTagName(strTag);
  var arr = new Array();
  var delim = strClass.indexOf('|') != -1  ? '|' : ' ';
  var arrClass = strClass.split(delim);
  var j = objColl.length;
  for (var i = 0; i < j; i++)
  {
    if(objColl[i].className == undefined) continue;
    var arrObjClass = objColl[i].className.split ? objColl[i].className.split(' ') : [];
    if (delim == ' ' && arrClass.length > arrObjClass.length) continue;
    var c = 0;
    comparisonLoop:
    {
      var l = arrObjClass.length;
      for (var k = 0; k < l; k++)
      {
        var n = arrClass.length;
        for (var m = 0; m < n; m++)
        {
          if (arrClass[m] == arrObjClass[k]) c++;
          if (( delim == '|' && c == 1) || (delim == ' ' && c == arrClass.length))
          {
            arr.push(objColl[i]);
            break comparisonLoop;
          }
        }
      }
    }
  }
  return arr;
}

function WebDebugToggleMenu()
{
  var element = document.getElementById('WebDebugDetails');

  var cacheElements = WebDebugGetElementsByClassName('WebDebugCache');
  var mainCacheElements = WebDebugGetElementsByClassName('WebDebugActionCache');
  var panelElements = WebDebugGetElementsByClassName('WebDebugTop');

  if (element.style.display != 'none')
  {
    for (var i = 0; i < panelElements.length; ++i)
    {
      panelElements[i].style.display = 'none';
    }

    // hide all cache information
    for (var i = 0; i < cacheElements.length; ++i)
    {
      cacheElements[i].style.display = 'none';
    }
    for (var i = 0; i < mainCacheElements.length; ++i)
    {
      mainCacheElements[i].style.border = 'none';
    }
  }
  else
  {
    for (var i = 0; i < cacheElements.length; ++i)
    {
      cacheElements[i].style.display = '';
    }
    for (var i = 0; i < mainCacheElements.length; ++i)
    {
      mainCacheElements[i].style.border = '1px solid #f00';
    }
  }

  WebDebugToggle('WebDebugDetails');
  WebDebugToggle('WebDebugShowMenu');
  WebDebugToggle('WebDebugHideMenu');
}

function WebDebugShowDetailor(element)
{
  if (typeof element == 'string')
  element = document.getElementById(element);

  var panelElements = WebDebugGetElementsByClassName('WebDebugTop');
  for (var i = 0; i < panelElements.length; ++i)
  {
    if (panelElements[i] != element)
    {
      panelElements[i].style.display = 'none';
    }
  }

  WebDebugToggle(element);
}

function WebDebugToggle(element)
{
  if (typeof element == 'string')
    element = document.getElementById(element);

  if (element)
    element.style.display = element.style.display == 'none' ? '' : 'none';
}

function date_heure(id)
{
  date = new Date;
  annee = date.getFullYear();
  moi = date.getMonth();
  mois = new Array('Janvier', 'F&eacute;vrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Ao&ucirc;t', 'Septembre', 'Octobre', 'Novembre', 'D&eacute;cembre');
  j = date.getDate();
  jour = date.getDay();
  jours = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
  h = date.getHours();
  if(h<10)
  {
    h = "0"+h;
  }
  m = date.getMinutes();
  if(m<10)
  {
    m = "0"+m;
  }
  s = date.getSeconds();
  if(s<10)
  {
    s = "0"+s;
  }
  resultat = h+':'+m+':'+s;
  document.getElementById(id).innerHTML = resultat;
  setTimeout('date_heure("'+id+'");','1000');
  return true;
}