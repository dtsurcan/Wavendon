// form location parameter get it's value by parameter name
function ErrorMessage(ErrText) {
  alert(ErrText)
}
function GetYearMonthOfDate(Date) {
  var L= Date.length
  if ( L< 6 ) return Date;
  return Date.substr(2,6);
}

function AdminTROver(RowName) {
  document.getElementById( RowName ).className= "admin_row2_hover"
}

function AdminTROut(RowName) {
  K= RowName.indexOf('_odd');
  if ( K>= 0 ) {
    document.getElementById( RowName ).className= "admin_row2_even"
  }
  K= RowName.indexOf('_even');
  if ( K>= 0 ) {
    document.getElementById( RowName ).className= "admin_row2_odd"
  }
}

function ClearUnsafeCookieChars(Str) {
  //Str= Str.replace ( /,/g, "_" );
  //Str= Str.replace ( /;/g, "_" );
  Str= Str.replace ( / /g, "_" );
  //Str= Str.replace ( /\t/g, "_" );
  return Str;
}

function HasUnsafeCookieChars(Str) {
  K= Str.indexOf('+');
  if ( K>= 0 ) return '+';
  K= Str.indexOf('_');
  if ( K>= 0 ) return '_';
  K= Str.indexOf(',');
  if ( K>= 0 ) return ',';
  K= Str.indexOf(';');
  if ( K>= 0 ) return ';';
  K= Str.indexOf('\t');
  if ( K>= 0 ) return '\t';
  return '';
}

function CheckEmail(value) {
  regex=/^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
  return regex.test(value);
}

function CheckInteger(value) {
  regex=/^[0-9]+$/;
  return regex.test(value);
}

function CheckFloat(value) {  
  // value= "87.";  //"2034.33";
  // regex= /^\d+(\.\d\d)?$/;
  regex= /^\d+(\.\d{0,2})?$/;
  // regex= /^[1-9]\d{2,4}([\.,]\d\d)?$/;
  // alert( regex+"  value::"+value )
  return regex.test(value);
  //return isNaN(parseFloat(value)) 
}

function SwitcherShowHide(FieldName) {
  //alert( "SwitcherShowHide  FieldName::"+FieldName );
  var CurrentStatus= document.getElementById( "sw_"+FieldName ).innerHTML;
  //alert("CurrentStatus::"+CurrentStatus)
  if ( CurrentStatus=='hide from others' ) {
    document.getElementById( "sw_"+FieldName ).innerHTML= "show to others";
    isshow=0;
  } else {
    document.getElementById( "sw_"+FieldName ).innerHTML= "hide from others";
    isshow=1;
  }

  var HRef= '/profile/set_public_profile?fieldname='+encodeURIComponent(FieldName)+'&isshow='+isshow;
  //alert(HRef);
  new Ajax.Request(HRef,{ // set public profile optrions for logged user
    method:'post',
    parameters: '',
    asynchronous: false,
    onComplete: function(server)
    {
      //alert("!!::"+server.responseText);
    }
  })

}


function GetParameterValue(ParameterName) {
  if ( location.search.length > 1 ) {
    var QueryString = location.search.substring( 1, location.search.length );
    var ParameterValueArr = QueryString.split( '&' );
    for ( var I = 0; I < ParameterValueArr.length; I++ ) {
      var Element = ParameterValueArr[I].split( '=' );
      if ( ParameterName== Element[0] ) {
        return Element[1];
      }
    }
  }
  return '';
}


function dBug_toggleRow(source) {
  target=(document.all) ? source.parentElement.cells[1] : source.parentNode.lastChild
  dBug_toggleTarget(target,dBug_toggleSource(source));
}

function dBug_toggleSource(source) {
  if (source.style.fontStyle=='italic') {
    source.style.fontStyle='normal';
    source.title='click to collapse';
    return 'open';
  } else {
    source.style.fontStyle='italic';
    source.title='click to expand';
    return 'closed';
  }
}

function dBug_toggleTarget(target,switchToState) {
  target.style.display=(switchToState=='open') ? '' : 'none';
}

function dBug_toggleTable(source) {
  var switchToState=dBug_toggleSource(source);
  if(document.all) {
    var table=source.parentElement.parentElement;
    for(var i=1;i<table.rows.length;i++) {
      target=table.rows[i];
      dBug_toggleTarget(target,switchToState);
    }
  }
  else {
    var table=source.parentNode.parentNode;
    for (var i=1;i<table.childNodes.length;i++) {
      target=table.childNodes[i];
      if(target.style) {
        dBug_toggleTarget(target,switchToState);
      }
    }
  }
}


function GetBrowserType() {
  //    alert(navigator.appName);
  if ( navigator.appName.indexOf("Microsoft") != -1 ) {
    return 'MSIE';
  }
  if ( navigator.appName.indexOf("Opera") != -1 ) {
    return 'Opera';
  }
  if ( navigator.appName.indexOf("Netscape") != -1 ) {
    return 'Netscape';
  }

  return '';
}

function GetShowTRMethod() {
  var BrowserType= GetBrowserType();
  //alert("BrowserType:"+BrowserType);
  if ( BrowserType== 'MSIE' ) return 'inline';
  if ( BrowserType== 'Opera' ) return 'table-row';
  if ( BrowserType== 'Netscape' ) return 'table-row';
  return '';
}

function GetShowCellMethod() {
  var BrowserType= GetBrowserType();
  //alert("BrowserType:"+BrowserType);
  if ( BrowserType== 'MSIE' ) return 'inline';
  if ( BrowserType== 'Opera' ) return 'table-cell';
  if ( BrowserType== 'Netscape' ) return 'table-cell';
  return '';
}


function formatPhone( obj ) {
  var phone = obj.value;
  var digits = phone.replace ( /[^0-9]/ig, "" );
  if ( !digits ) {
    return phone;
  }
  if ( digits.length == 10 ) {
    phone = "(" + digits.substring ( 0, 3 ) + ") " + digits.substring ( 3, 6 ) + "-" + digits.substring ( 6, 10 );
  } else {
    phone = digits;
  }
  return phone;
}

// format zip
function formatZip( obj ) {
  var zip = obj.value;
  var digits = zip.replace ( /[^0-9]/ig, "" );
  if ( !digits ) {
    return zip;
  }
  if ( digits.length == 9 ) {
    zip = digits.substring ( 0, 5 ) + "-" + digits.substring ( 5, 9 );
  } else {
    zip = digits;
  }
  return zip;
}




function isVerifyFilled( theForm, VerifyArr ) {
  var i, j, L, K, FieldName, FieldTitle;
  L= VerifyArr.length
  for(j=0; j< L; j++) {
    K= VerifyArr[j].indexOf('-');
    if ( K>= 0 ) {
      FieldName= VerifyArr[j].substring(0,K);
      FieldTitle= VerifyArr[j].substring( K + 1,VerifyArr[j].length );
    }
    else {
      FieldName= VerifyArr[j]
      FieldTitle= ""
    }
    for (i=0; i< theForm.elements.length; i++) {
      //alert( theForm.elements[i].name );
      if ( theForm.elements[i].name == FieldName && Trim(theForm.elements[i].value) == "" ) {
        alert('��������� ���� "' + FieldTitle+'" !');
        theForm.elements[i].focus();
        return false;
      }
    }
  }
  return true;
} // function isVerifyFilled( VerifyArr )


function t_ChangeAll( S, SearchS, ChangeS ) {
  var K,Index= 0;
  K= S.indexOf( SearchS,Index );
  UpSearchS= SearchS.toUpperCase();
  while (K> 0) {
    Index= K+ChangeS.length;
    S= S.substring( 0,K ) + ChangeS + S.substring (K + SearchS.length,250 );
    K= S.toUpperCase().indexOf( SearchS.toUpperCase(),Index );
  }
  //  alert(S);
  return S;
} // function t_ChangeAll( S, SearchS, ChangeS ) {

function GetFormValue( theForm, ObjName ) {
  var I;
  for (I=0; I< theForm.elements.length; I++) {
    if ( theForm.elements[I].name == ObjName ) {
      return  theForm.elements[I].value;
    }
  }
  return "";
}

function SetFormValue( theForm, ObjName, Value ) {
  var I;
  for (I=0; I< theForm.elements.length; I++) {
    if ( theForm.elements[I].name == ObjName ) {
      theForm.elements[I].value= Value;
      return true;
    }
  }
  return false;
}


function isNumber( S, isNegative, isZero ) {
  var I, L, TempS;
  TempS= Trim( TrimChar(S,'0',1) );
  if ( !isZero && ( TempS== "0" || TempS== "" ) ) return false;
  L= S.length;
  for (I= 0; I< L; I++) {
    Ch= S.substring(I,I+1);
    if ( Ch< "0" || Ch> "9") {
      if ( !( isNegative && Ch=="-" && I== 0 ) ) {
        return false;
      }
    }
  }
  return true;
} // function isNumber( S, isNegative )

function isNumberFloat( S, isNegative, isZero, FlaotNumber ) {
  var I, L, TempS, K, KKK, RoundDigit, FloatDigit, RoundDigitTempS, FloatDigitTempS;
  K= S.toUpperCase().indexOf( ',' );
  KKK= S.toUpperCase().indexOf( '.' );
  //  alert(K,'11::');
  //  alert(KKK,'22::');
  if ( K!= -1 && KKK!= -1 ) {  // and
    //    v("Double point");
    return false;
  }
  if ( K== -1 && KKK== -1 ) {
    RoundDigit= S;
    FloatDigit= '';
  } else {
    if ( K== -1 && KKK> 0 ) {
      //  v("heare");
      K= KKK;
    }
    //  alert(K);
    RoundDigit= S.substring(0,K);
    FloatDigit= S.substring(K+1);
  }
  //  alert(RoundDigit,'RoundDigit:::::');
  //  alert(FloatDigit,'FloatDigit:::::');
  //  TempS= Trim( TrimChar(S,'0',1) );
  RoundDigitTempS= Trim( TrimChar(RoundDigit,'0',1) );
  FloatDigitTempS= Trim( TrimChar(FloatDigit,'0',1) );
  //  alert(RoundDigitTempS);
  //  alert(FloatDigitTempS);

  if ( (   !isZero && ( RoundDigitTempS== "0" || RoundDigitTempS== "" ) )   &&
  ( !isZero && ( FloatDigitTempS== "0" || FloatDigitTempS== "" ) ) )  {
    //    alert("Zero");
    return false;
  }
  //  alert("permit zero");
  L= RoundDigitTempS.length;
  for (I= 0; I< L; I++) {
    Ch= RoundDigitTempS.substring(I,I+1);
    if ( Ch< "0" || Ch> "9") {
      if ( !( isNegative && Ch=="-" && I== 0 ) ) {
        return false;
      }
    }
  }

  L= FloatDigitTempS.length;
  for (I= 0; I< L; I++) {
    Ch= FloatDigitTempS.substring(I,I+1);
    if ( Ch< "0" || Ch> "9") {
      //      if ( !( isNegative && Ch=="-" && I== 0 ) ) {
      return false;
      //      }
    }
  }
  return true;
} // isNumberFloat( S, isNegative, isZero, FlaotNumber ) {


/* function isNumberFloat( S, isNegative, isZero, FlaotNumber ) {
var I, L, TempS, K, KKK, RoundDigit, FloatDigit, RoundDigitTempS, FloatDigitTempS;
K= S.toUpperCase().indexOf( ',' );
KKK= S.toUpperCase().indexOf( '.' );
//  v($K,'11::');
//  v($KKK,'22::');
if ( K!= -1 && KKK!= -1 ) {  // and
//    v("Double point");
return false;
}
if ( K== -1 && KKK> 0 ) {
//  v("heare");
K= KKK;
}
//  alert(K);
RoundDigit= S.substring(0,K);
FloatDigit= S.substring(K+1);
//  v($RoundDigit,'RoundDigit:::::');
//  v($FloatDigit,'FloatDigit:::::');
//  TempS= Trim( TrimChar(S,'0',1) );
RoundDigitTempS= Trim( TrimChar(RoundDigit,'0',1) );
FloatDigitTempS= ( TrimChar(FloatDigit,'0',1) );
//  alert(RoundDigitTempS);
//  alert(FloatDigitTempS);

if ( (   !isZero && ( RoundDigitTempS== "0" || RoundDigitTempS== "" ) )   &&
( !isZero && ( FloatDigitTempS== "0" || FloatDigitTempS== "" ) ) )  {
//    alert("Zero");
return false;
}
//  alert("permit zero");
L= RoundDigitTempS.length;
for (I= 0; I< L; I++) {
Ch= RoundDigitTempS.substring(I,I+1);
if ( Ch< "0" || Ch> "9") {
if ( !( isNegative && Ch=="-" && I== 0 ) ) {
return false;
}
}
}

L= FloatDigitTempS.length;
for (I= 0; I< L; I++) {
Ch= FloatDigitTempS.substring(I,I+1);
if ( Ch< "0" || Ch> "9") {
if ( !( isNegative && Ch=="-" && I== 0 ) ) {
return false;
}
}
}
return true;
} // isNumberFloat( S, isNegative, isZero, FlaotNumber ) {

*/
function Mod( Digit, Dividor ) {
  if ( Dividor== 0 ) {
    return 0;
  }
  return Math.ceil(Digit/Dividor);
}

function isDate( Day, Month, Year ) {
  if (typeof Day== "undefined") return false;
  if (typeof Month== "undefined") return false;
  if (typeof Year== "undefined") return false;
  //  alert("isDate  Day:"+Day+"  Month:"+Month+"  Year:"+Year);
  if ( Month== 1 || Month== 3 || Month== 5 || Month== 7 || Month== 8 || Month== 10 || Month== 12 ) {
    if ( Day>31 || Day<= 0 ) { return false; }
  }
  if ( Month== 4 || Month== 6 || Month== 9 || Month== 11 ) {
    if ( Day> 30 || Day<= 0 ) { return false; }
  }
  if ( Month== 2 ) {
    if ( ( Year % 4 )== 0 ) { // Leap Year
      if ( Day> 29 ) {
        return false;
      }
    } else {
      if ( Day> 28 ) { return false; }
    }
  }  // if ( Month== 2 } {
  return true;
}

function Concat( S, S1, S2 ) {
  return S + S1 + S2;
}

function TrimChar( S, ChrS, MinLength ) {
  while ( S.substring(0,1) == ChrS && S.length> MinLength ) {
    S= S.substring( 1, S.length );
  }
  while ( S.substring( S.length-1, 1 ) == ChrS && S.length> MinLength ) {
    S= S.substring( 0, S.length-1 );
  }
  return S;
}



function GetCenteredTop( ObjHeight ) {
  var H= screen.availHeight;
  return (H - ObjHeight)/2;
}
function GetCenteredLeft( ObjWidth ) {
  var H= screen.availWidth;
  return (H - ObjWidth)/2;
}

function Trim( S ) {

  try {

    if (typeof S== "undefined") return "";
    var Ch, Len;
    Len= S.length;
    if ( Len == 0 ) return "";
    Ch= S.substring(0,1); // Get the first symbol
    while( ( Ch== ' ' || Ch== '        ' || Ch.length== 0 ) && Len >= 1 ) {
      S= S.substring( 1,Len );
      Len= S.length;
      Ch= S.substring(0,1);  // Get the first symbol
    }
    Len= S.length;

    Ch= S.substring( Len-1, Len ); // Get the last symbol
    while( ( Ch== ' ' || Ch== '        ' || Ch.length== 0 ) && Len >= 1 ) {
      S= S.substring( 0,Len-1 );
      Len= S.length;
      Ch= S.substring(Len-1 ,Len );  // Get the last symbol
    }
    return S;

  } catch (e) {

    return "";

  }

} // function Trim( S ) {



var MAX_DUMP_DEPTH = 20;
function dumpObj(obj, name, indent, depth) {

  if (depth > MAX_DUMP_DEPTH) {

    return indent + name + ": <Maximum Depth Reached>\n";

  }

  if (typeof obj == "object") {

    var child = null;

    var output = indent + name + "\n";

    indent += "\t";

    for (var item in obj)

    {

      try {

        child = obj[item];

      } catch (e) {

        child = "<Unable to Evaluate>";

      }

      if (typeof child == "object") {

        output += dumpObj(child, item, indent, depth + 1);

      } else {

        output += indent + item + ": " + child + "\n";

      }

    }

    return output;

  } else {

    return obj;

  }

}



function var_dump(oElem) {
  var sStr = '';
  if (typeof(oElem) == 'string' || typeof(oElem) == 'number')     {
    sStr = oElem;
  } else {
    var sValue = '';
    for (var oItem in oElem) {
      sValue = oElem[oItem];
      if (typeof(oElem) == 'innerHTML' || typeof(oElem) == 'outerHTML') {
        sValue = sValue.replace(/</g, '&lt;').replace(/>/g, '&gt;');
      }
      sStr += 'obj.' + oItem + ' = ' + sValue + '\n';
    }
  }
  return sStr;
}

function ClearDDLBItems(FieldName, ClearFirstElement ) {
  var ddlbObj= document.getElementById(FieldName);
  try {
  var L= ddlbObj.length;
  } 
  catch(e) {  
  	//alert( "ClearDDLBItems FieldName::"+FieldName ) 
  }
  for (var I= L-1; I>=1; I-- ) {
    ddlbObj.remove(I);
  }
  if ( ClearFirstElement ) ddlbObj.remove(0);
}

function AddDDLBItem( FieldName, id, text) {
  var ddlbObj= document.getElementById(FieldName);
  var OptObj = document.createElement("OPTION");
  OptObj.value= id;
  OptObj.text= text;
  ddlbObj.options.add(OptObj);
  return OptObj;
}

function SetDDLBActiveItem( FieldName, Value) {
  var ddlbObj= document.getElementById(FieldName);
  if ( !ddlbObj ) alert("Error::"+FieldName )
  for(var I=0;I<ddlbObj.options.length;I++) {
    //alert( ddlbObj.options[I].value+"::"+Value )
    if ( ddlbObj.options[I].value == Value ) {
      //alert("INSIDE: "+I)
      ddlbObj.options[I].selected = true;
      return;
    }
  }
}

function FillDdlbValue( FieldName, id, text, AddEmpty ) {
  var ddlbObj= document.getElementById(FieldName);
  for(var I=0;I<ddlbObj.options.length;I++) {
    if ( ddlbObj.options[I].value == id ) {
      ddlbObj.options[I].selected = true;
      return;
    }
  }
  AddDDLBItem( FieldName, id, text)
  SetDDLBActiveItem( FieldName, id)
}

function ClearDDLBActiveItem( FieldName) {
  var ddlbObj= document.getElementById(FieldName);
  //  alert("ddlbObj.options.length::"+ddlbObj.options.length);
  for(var I=0;I<ddlbObj.options.length;I++) {
    ddlbObj.options[I].selected = false;
  }
}
