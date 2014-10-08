//JLL 04/Oct/2007	Esta funcion se encarga de validar que el campo indicado con obj_Field contenga un valor aceptable para el tipo de campo indicado en str_Type.
function int_fn_Validate_Field(str_Type, obj_Field){
	if(obj_Field == null || obj_Field == ""){
		return 0; //Empty field.
	}
	if(obj_Field.toLowerCase().indexOf("script ") > -1){
		return -1; //script_ tag detected.
	}
	switch(str_Type){
		case "txt" : //any string is aceptable.
					break;
		case "txt_" || "url" : //spaces are not permitted.
					if(obj_Field.indexOf(" ") > -1)
						return -1;		
					break;
		case "usr" || "psw" : //Avoid SQL and spaces.
					if(obj_Field.indexOf(" ") > -1 ||
						obj_Field.indexOf("\'") > -1 ||
						obj_Field.indexOf("\"") > -1 ||
						obj_Field.toLowerCase().indexOf(" true ") > -1 ||
						obj_Field.toLowerCase().indexOf(" false ") > -1)
						return -1;		
					break;	
		case "bus" : //Avoid SQL on searches.
					if(obj_Field.indexOf("\'") > -1 ||
						obj_Field.indexOf("\"") > -1 ||
						obj_Field.toLowerCase().indexOf(" true ") > -1 ||
						obj_Field.toLowerCase().indexOf(" false ") > -1)
						return -1;		
					break;						
		case "email" : //shoeld be a valid email address.
					if(!bln_fn_Validate_Email(obj_Field))
						return -1;		
					break;
		case "num" : //should be any number.
					if(!bln_fn_Validate_Number(obj_Field))
						return -1;		
					break;	
	}
	
	return 1; //the field is aceptable for the type especified.
}

function bln_fn_Validate_Number(obj_Field){
	str_Num = obj_Field;

	if(str_Num.indexOf("+") > -1)
		if(str_Num.lastIndexOf("+") > 0)
			return false;
	if(str_Num.indexOf("-") > -1)
		if(str_Num.lastIndexOf("-") > 0)
			return false;
	if(str_Num.indexOf(".") > -1)
		if(str_Num.indexOf(".") != str_Num.lastIndexOf("."))
			return false;			
	bln_Digit = false;
	bln_Some_Digit = false;
	for(int_i = 0; int_i < str_Num.length; int_i++){
		if(str_Num.charAt(int_i) != "+" && str_Num.charAt(int_i) != "-" && str_Num.charAt(int_i) != "."){
			for(int_j = 0; int_j <= 9; int_j++){
				if(str_Num.charAt(int_i) == int_j.toString()){
					bln_Digit = true;
					bln_Some_Digit = true;
					break;
				}
			}
			if(!bln_Digit)
				return false;
			bln_Digit = false;
		}
	}
	if(bln_Some_Digit == true)
		return true;
	else
		return false;
}

function bln_fn_Validate_Email(obj_Field){
	str_Email = obj_Field;

	int_pos = str_Email.indexOf('@',0);
	int_pos2 = str_Email.indexOf('.',0);
	int_posa = int_pos2;
	while(int_pos2 > -1){
		if(int_pos2 == 0 || int_pos2 == int_pos-1 || int_pos2 == int_posa+1 || int_pos2 == str_Email.length-1 || int_pos2 == int_pos+1)
			return false;
		int_posa = int_pos2;
		int_pos2 = str_Email.indexOf('.',int_posa+1);
	}
	if(str_Email == '' || int_pos < 1 || str_Email.indexOf(';',0) != -1
	|| str_Email.indexOf(' ',0) != -1 || str_Email.indexOf('/',0) != -1
	|| str_Email.indexOf(';',0) != -1 || str_Email.indexOf('<',0) != -1
	|| str_Email.indexOf('>',0) != -1 || str_Email.indexOf('*',0) != -1
	|| str_Email.indexOf('|',0) != -1 || str_Email.indexOf('`',0) != -1
	|| str_Email.indexOf('&',0) != -1 || str_Email.indexOf('$',0) != -1
	|| str_Email.indexOf('!',0) != -1 || str_Email.indexOf('"',0) != -1
	|| str_Email.indexOf(':',0) != -1)
		return false;
	else	
		return true;
}