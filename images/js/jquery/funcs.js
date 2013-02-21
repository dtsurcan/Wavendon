// form location parameter get it's value by parameter name
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


function FillInitialValues(FieldsArray) {
  L= FieldsArray.length
  for(j=0; j< L; j++) {
    var FieldName= FieldsArray[j];
    var value= Trim(document.getElementById( FieldName ).value);
    InitialValuesArray[InitialValuesArray.length] = new FieldPair( FieldName , value);
  }
}

function FieldPair(FieldName, InitialValue) {
  this.FieldName = FieldName;
  this.InitialValue = InitialValue;
}

function isDataChanged() {
  var L= InitialValuesArray.length
  for(I=0; I< L;I++) {
    var FieldName= InitialValuesArray[I].FieldName;
    var InitialValue= InitialValuesArray[I].InitialValue;
    var Value= Trim(document.getElementById(FieldName).value);
    if (InitialValue != Value ) return true;
  }
  return false;
}

function VerifyFilled( FieldsArray, FillText, FieldText ) {
  L= FieldsArray.length
  for(j=0; j< L; j++) {
    var FieldName= FieldsArray[j];
    var value= Trim(document.getElementById( FieldName ).value);
    if( value=="" ) {
      var SpanName= "span_label_for_"+FieldName
      var LabelText= FieldName;
      if ( document.getElementById(SpanName) ) LabelText= document.getElementById(SpanName).innerHTML
      alert(FillText+" '"+LabelText+"' "+ FieldText+" ! ");
      document.getElementById( FieldName ).focus();
      return false;
    }
  }
  return true;
}

function Trim( S ) {
  var Ch, Len;
  Len= S.length;
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
} // function Trim( S ) {


function setCookie(name, value, expires, path, domain, secure) {
  document.cookie = name + "=" + escape (value) +
  ((expires) ? "; expires=" + expires : "") +
  ((path) ? "; path=" + path : "") +
  ((domain) ? "; domain=" + domain : "") +
  ((secure) ? "; secure" : "");
}

function ClearDDLBItems(FieldName, ClearFirstElement ) {
  var ddlbObj= document.getElementById(FieldName);
  var L= ddlbObj.length;
  for (I= L-1; I>=1; I-- ) {
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
  //alert(" SetDDLBActiveItem ddlbObj.options.length::"+ddlbObj.options.length);
  for(I=0;I<ddlbObj.options.length;I++) {
    //alert( "ddlbObj.options[I].value:::"+ddlbObj.options[I].value +"    Value:::"+ Value );
    if ( ddlbObj.options[I].value == Value ) {
      ddlbObj.options[I].selected = true;
      return;
    }
  }
}

function ClearDDLBActiveItem( FieldName) {
  var ddlbObj= document.getElementById(FieldName);
  //  alert("ddlbObj.options.length::"+ddlbObj.options.length);
  for(I=0;I<ddlbObj.options.length;I++) {
    ddlbObj.options[I].selected = false;
  }
}

////////////////////////////////////////////////////
function dump(arr,level) {
  var dumped_text = "";
  if(!level) level = 0;

  //The padding given at the beginning of the line.
  var level_padding = "";
  for(var j=0;j<level+1;j++) level_padding += "    ";

  if(typeof(arr) == 'object') { //Array/Hashes/Objects
    for(var item in arr) {
      var value = arr[item];

      if(typeof(value) == 'object') { //If it is an array,
        dumped_text += level_padding + "'" + item + "' ...\n";
        dumped_text += dump(value,level+1);
      } else {
        dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
      }
    }
  } else { //Stings/Chars/Numbers etc.
    dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
  }
  return dumped_text;
}

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

