var residence = document.getElementById("residence").value;
	if((residence=="select")){
		document.getElementById("fullForm").style.display = "none";
	}
document.getElementById("salaryForm").style.display = "none";	
document.getElementById("houseForm").style.display = "none";
document.getElementById("capitalForm").style.display = "none";
document.getElementById("otherForm").style.display = "none";
document.getElementById("bussinessForm").style.display = "none";
document.getElementById("agriForm").style.display = "none";
document.getElementById("deductionsForm").style.display = "none";
document.getElementById("grossForm").style.display = "none";
document.getElementById("calculationForm").style.display = "none";

document.getElementById("p1").style.display = "none";	
document.getElementById("p3").style.display = "none";
document.getElementById("p5").style.display = "none";
document.getElementById("p7").style.display = "none";
document.getElementById("p9").style.display = "none";
document.getElementById("p11").style.display = "none";
document.getElementById("p13").style.display = "none";
document.getElementById("p15").style.display = "none";
document.getElementById("p17").style.display = "none";

document.getElementById("p0").style.display = "block";	
document.getElementById("p2").style.display = "block";
document.getElementById("p4").style.display = "block";
document.getElementById("p6").style.display = "block";
document.getElementById("p8").style.display = "block";
document.getElementById("p10").style.display = "block";
document.getElementById("p12").style.display = "block";
document.getElementById("p14").style.display = "block";
document.getElementById("p16").style.display = "block";

function popup(){
	var residence = document.getElementById("residence").value;
	if((residence!="select")){
		document.getElementById("fullForm").style.display = "block";
	}
	else{
		document.getElementById("fullForm").style.display = "none";
		
	}
}
function salary1(){
	document.getElementById("salaryForm").style.display = "block";
	document.getElementById("p1").style.display = "block";
	document.getElementById("p0").style.display = "none";
}
function salary2(){
	document.getElementById("salaryForm").style.display = "none";
	document.getElementById("p1").style.display = "none";
	document.getElementById("p0").style.display = "block";
}

function house1(){
	document.getElementById("houseForm").style.display = "block";
	document.getElementById("p3").style.display = "block";
	document.getElementById("p2").style.display = "none";
}
function house2(){
	document.getElementById("houseForm").style.display = "none";
	document.getElementById("p3").style.display = "none";
	document.getElementById("p2").style.display = "block";
}

function capital1(){
	document.getElementById("capitalForm").style.display = "block";
	document.getElementById("p5").style.display = "block";
	document.getElementById("p4").style.display = "none";
}function capital2(){
	document.getElementById("capitalForm").style.display = "none";
	document.getElementById("p5").style.display = "none";
	document.getElementById("p4").style.display = "block";
}

function other1(){
	document.getElementById("otherForm").style.display = "block";
	document.getElementById("p7").style.display = "block";
	document.getElementById("p6").style.display = "none";
}
function other2(){
	document.getElementById("otherForm").style.display = "none";
	document.getElementById("p7").style.display = "none";
	document.getElementById("p6").style.display = "block";
}

function bussiness1(){
	document.getElementById("bussinessForm").style.display = "block";
	document.getElementById("p9").style.display = "block";
	document.getElementById("p8").style.display = "none";
}
function bussiness2(){
	document.getElementById("bussinessForm").style.display = "none";
	document.getElementById("p9").style.display = "none";
	document.getElementById("p8").style.display = "block";
}

function agri1(){
	document.getElementById("agriForm").style.display = "block";
	document.getElementById("p11").style.display = "block";
	document.getElementById("p10").style.display = "none";
}
function agri2(){
	document.getElementById("agriForm").style.display = "none";
	document.getElementById("p11").style.display = "none";
	document.getElementById("p10").style.display = "block";
}


function deductionsa(){
	document.getElementById("deductionsForm").style.display = "block";
	document.getElementById("p13").style.display = "block";
	document.getElementById("p12").style.display = "none";
}
function deductionsb(){
	document.getElementById("deductionsForm").style.display = "none";
	document.getElementById("p13").style.display = "none";
	document.getElementById("p12").style.display = "block";
}

function gross1(){
	document.getElementById("grossForm").style.display = "block";
	document.getElementById("p15").style.display = "block";
	document.getElementById("p14").style.display = "none";
}
function gross2(){
	document.getElementById("grossForm").style.display = "none";
	document.getElementById("p15").style.display = "none";
	document.getElementById("p14").style.display = "block";
}

function calculation1(){
	document.getElementById("calculationForm").style.display = "block";
	document.getElementById("p17").style.display = "block";
	document.getElementById("p16").style.display = "none";
}
function calculation2(){
	document.getElementById("calculationForm").style.display = "none";
	document.getElementById("p17").style.display = "none";
	document.getElementById("p16").style.display = "block";
}

function printform(){
	document.getElementById("salaryForm").style.display = "block";	
document.getElementById("houseForm").style.display = "block";
document.getElementById("capitalForm").style.display = "block";
document.getElementById("otherForm").style.display = "block";
document.getElementById("bussinessForm").style.display = "block";
document.getElementById("agriForm").style.display = "block";
document.getElementById("deductionsForm").style.display = "block";
document.getElementById("grossForm").style.display = "block";
document.getElementById("calculationForm").style.display = "block";
	window.print();
       
}


function house1b(){
	var residence = document.getElementById("residence").value;
	var catagory = document.getElementById("catagory").value;

		//income from salary
		let ifs=Number(document.getElementById("ifs").value);
	
		//income from House Property
		let input=Number(document.getElementById("a1a").value);
		let loan=document.getElementById("a1b");
			loan.value=-(input);
	
		let a=Number(document.getElementById("b1").value);
		let b=Number(document.getElementById("b2").value);
		let c=Number(document.getElementById("b3").value);
		let output=document.getElementById("b4");
			output.value=a-(b+c);
		
		let d=document.getElementById("hi");
		if(output.value>0){
			d.value=output.value*0.30;                              //learn for hi as we have doubt about housing standard deduction
		}
		else{
			d.value=0;
		}
	
		let e=Number(document.getElementById("h2").value);
		let f=document.getElementById("h3");
			f.value=output.value-d.value-e;
		let ifhp=document.getElementById("ifhp");
	
		let temphouse=Number(loan.value)+Number(f.value);
		if(temphouse<-150000){
			ifhp.value=-150000;
		}
		else{
			ifhp.value=temphouse;
		}
	
	
		//Income From Other Sources
		let interest=Number(document.getElementById("interest").value);
		let commission=Number(document.getElementById("commission").value);
		let lottery=Number(document.getElementById("lottery").value);
		let ifos=document.getElementById("ifos");
		ifos.value=interest+commission+lottery;
	
		//lottery @30%
		let lottery2=document.getElementById("lottery2");
		let lotterytax=document.getElementById("lotterytax");
		lottery2.value=lottery;
		lotterytax.value=lottery*0.30;
	
		//Capital gain
			//Short Term Capital GainS (Other than covered under section 111A)
		let stcga1=Number(document.getElementById("stcga1").value);
		let stcga2=Number(document.getElementById("stcga2").value);
		let stcga3=Number(document.getElementById("stcga3").value);
		let stcga4=Number(document.getElementById("stcga4").value);
		let stcga5=Number(document.getElementById("stcga5").value);
		let stcga=document.getElementById("stcga");
			stcga.value=stcga1+stcga2+stcga3+stcga4+stcga5;
	
			//Short Term Capital GainS (Covered under section 111A)
		let stcgb1=Number(document.getElementById("stcgb1").value);
		let stcgb2=Number(document.getElementById("stcgb2").value);
		let stcgb3=Number(document.getElementById("stcgb3").value);
		let stcgb4=Number(document.getElementById("stcgb4").value);
		let stcgb5=Number(document.getElementById("stcgb5").value);
		let stcgb=document.getElementById("stcgb");
			stcgb.value=stcgb1+stcgb2+stcgb3+stcgb4+stcgb5;
	
			//Long Term Capital Gains (Charged to tax @ 20%)
		let ltcga1=Number(document.getElementById("ltcga1").value);
		let ltcga2=Number(document.getElementById("ltcga2").value);
		let ltcga3=Number(document.getElementById("ltcga3").value);
		let ltcga4=Number(document.getElementById("ltcga4").value);
		let ltcga5=Number(document.getElementById("ltcga5").value);
		let ltcga=document.getElementById("ltcga");
			ltcga.value=ltcga1+ltcga2+ltcga3+ltcga4+ltcga5;
	
	
			//Long Term Capital Gains (Charged to tax @ 10%)
		let ltcgb1=Number(document.getElementById("ltcgb1").value);
		let ltcgb2=Number(document.getElementById("ltcgb2").value);
		let ltcgb3=Number(document.getElementById("ltcgb3").value);
		let ltcgb4=Number(document.getElementById("ltcgb4").value);
		let ltcgb5=Number(document.getElementById("ltcgb5").value);
		let ltcgb=document.getElementById("ltcgb");
			ltcgb.value=ltcgb1+ltcgb2+ltcgb3+ltcgb4+ltcgb5;
	
	
		//INCOME FROM BUSINESS OR PROFESSION
		let ifb=Number(document.getElementById("ifb").value);
	
	
		//INCOME FROM AGRICULTURE
		let ifa=Number(document.getElementById("ifa").value);
	
	
		//80u checked
		let u80=document.getElementById("u80").checked;
		let u80d=document.getElementById("u80d").checked;
		let u803=document.getElementById("u803");
		if(u80){
			if(u80d){
				u803.value=125000;
			}
			else{
				u803.value=75000;
			}
		}
		else{
			u803.value=0;
		}
	
	
		//80dd checked
		let dd80=document.getElementById("dd80").checked;
		let dd80d=document.getElementById("dd80d").checked;
		let dd804=document.getElementById("dd804");
		if(dd80){
			if(dd80d){
				dd804.value=125000;
			}
			else{
				dd804.value=75000;
			}
		}
		else{
			dd804.value=0;
		}
	
	
		//Deductions
		let deductions1=Number(document.getElementById("deductions1").value);
		let deductions2=Number(document.getElementById("deductions2").value);
		let deductions3=Number(document.getElementById("deductions3").value);
		let deductions4=Number(document.getElementById("deductions4").value);
		let deductions5=Number(document.getElementById("deductions5").value);
		let deductions6=Number(document.getElementById("deductions6").value);
		let deductions7=Number(document.getElementById("deductions7").value);
		let deductions8=Number(document.getElementById("deductions8").value);
		let deductions9=Number(document.getElementById("deductions9").value);
		let deductions10=Number(document.getElementById("deductions10").value);
		let deductions11=Number(document.getElementById("deductions11").value);
		let deductions12=Number(document.getElementById("deductions12").value);
		let deductions13=Number(document.getElementById("deductions13").value);
		let deductions14=Number(document.getElementById("deductions14").value);
		let deductions15=Number(document.getElementById("deductions15").value);
		let deductions16=Number(document.getElementById("deductions16").value);
		let deductions17=Number(document.getElementById("deductions17").value);
		let tampdeduct=deductions1+deductions2+deductions3+deductions4+deductions5+deductions6+deductions7+deductions8+deductions9+deductions10+deductions11+deductions17+deductions16+deductions14;
		if(tampdeduct>150000){
			tampdeduct=150000;
		}
		else{
			tampdeduct=tampdeduct;
		}
		
		let deductiontotal=document.getElementById("deductiontotal");
			deductiontotal.value=tampdeduct+deductions12+deductions13+deductions15;
				//80dd
		let dd801=Number(document.getElementById("dd801").value);
		let dd802=Number(document.getElementById("dd802").value);
		let dd803=Number(document.getElementById("dd803").value);	
				//80u
		let u801=Number(document.getElementById("u801").value);
		let u802=Number(document.getElementById("u802").value);
				//us80tta and others
		let deductions18=Number(document.getElementById("deductions18").value);
		let deductions19=Number(document.getElementById("deductions19").value);
		let deductions=document.getElementById("deductions");
			deductions.value=Number(deductiontotal.value)+dd801+dd802+dd803+Number(dd804.value)+u801+u802+Number(u803.value)+deductions18+deductions19;
	
		//netTaxableAmount
		let netTaxableAmount=document.getElementById("netTaxableAmount");
			tempNetTaxable=ifs+Number(ifhp.value)+Number(stcga.value)+Number(stcgb.value)+Number(ltcga.value)+Number(ltcgb.value)+Number(ifos.value)+ifb-Number(deductions.value);
			if(tempNetTaxable<0){
				netTaxableAmount.value=0;
			}
			else{
				netTaxableAmount.value=tempNetTaxable;
			}
	
	
		//Tax Calculation
			//SHORT TERM CAPITAL GAINS (COVERED U/S 111A) 15%
		let stcg15a=document.getElementById("stcg15a");
		let stcg15t=document.getElementById("stcg15t");	
		if(Number(stcgb.value)>250000){
			stcg15a.value=Number(stcgb.value)-250000;
			stcg15t.value=Number(stcg15a.value)*0.15;
		}
	
			//LONG TERM CAPITAL GAINS (CHARGED TO TAX @ 20%) 20%
		let ltcg15a=document.getElementById("ltcg15a");
		let ltcg15t=document.getElementById("ltcg15t");	
		if(Number(ltcga.value)>250000){
			ltcg20a.value=Number(ltcga.value)-250000;
			ltcg20t.value=Number(ltcg20a.value)*0.20;
		}
	
			//LONG TERM CAPITAL GAINS (CHARGED TO TAX @ 10%) 10%
		let ltcg10a=document.getElementById("ltcg10a");
		let ltcg10t=document.getElementById("ltcg10t");	
		if(Number(ltcgb.value)>250000){
			ltcg10a.value=Number(ltcgb.value)-250000;
			ltcg10t.value=Number(ltcg10a.value)*0.10;
		}
	
			//Income Liable to Tax at Normal Rate ---
		let taxAtNormala=document.getElementById("taxAtNormala");
		let taxAtNormalt=document.getElementById("taxAtNormalt");	
			let normalAmount=Number(netTaxableAmount.value)-Number(lottery2.value)-Number(stcgb.value)-Number(ltcga.value)-Number(ltcgb.value);
			taxAtNormala.value=normalAmount;
						//IncomeTax Slabes
			if(catagory=="Male" || catagory=="Female"){
				if(normalAmount<=250000){
					taxAtNormalt.value=0;
				}
				else if(normalAmount>250000 && normalAmount<=500000){
					taxAtNormalt.value=(normalAmount-250000)*0.05;
				}
				else if(normalAmount>500000 && normalAmount<=1000000){
					taxAtNormalt.value=(normalAmount-500000)*0.20+250000*0.05;
				}
				else if(normalAmount>1000000){
					taxAtNormalt.value=(normalAmount-1000000)*0.30+500000*0.20+250000*0.05;
				}
			}
			else if(catagory=="Senior Citizen"){
				if(normalAmount<=300000){
					taxAtNormalt.value=0;
				}
				else if(normalAmount>300000 && normalAmount<=500000){
					taxAtNormalt.value=(normalAmount-300000)*0.05;
				}
				else if(normalAmount>500000 && normalAmount<=1000000){
					taxAtNormalt.value=(normalAmount-500000)*0.20+200000*0.05;
				}
				else if(normalAmount>1000000){
					taxAtNormalt.value=(normalAmount-1000000)*0.30+200000*0.05+500000*0.20;
				}
			}
			else if(catagory=="Super Senior Citizen"){
				if(normalAmount<=500000){
					taxAtNormalt.value=0;
				}
				else if(normalAmount>500000 && normalAmount<=1000000){
					taxAtNormalt.value=(normalAmount-500000)*0.20;
				}
				else if(normalAmount>1000000){
					taxAtNormalt.value=(normalAmount-1000000)*0.30+500000*0.20;
				}
			}
			
			//INCOME TAX AFTER RELIEF U/S 87A
			let a87=document.getElementById("a87");
			if(Number(netTaxableAmount.value)<=350000){
				if(Number(taxAtNormalt.value)<=2500){
					a87.value=0;
				}
				else{
					a87.value=Number(taxAtNormalt.value)+Number(stcg15t.value)+Number(ltcg10t.value)+Number(ltcg20t.value)-2500;
				}
			}
			else{
				a87.value=Number(taxAtNormalt.value)+Number(stcg15t.value)+Number(ltcg10t.value)+Number(ltcg20t.value);
			}
			
			//surcharge
			let surcharge=document.getElementById("surcharge");
			if(Number(netTaxableAmount.value)>5000000 && Number(netTaxableAmount.value)<=10000000){
				surcharge.value=Number(a87.value)*0.10;
			}
			else if(Number(netTaxableAmount.value)>10000000){
				surcharge.value=Number(a87.value)*0.15;
			}
			
			//EDUCATION CESS
			let ecess=document.getElementById("ecess");
				ecess.value=(Number(a87.value)+Number(surcharge.value))*0.02;
			
			//SECONDARY AND HIGHER EDUCATION CESS
			let scess=document.getElementById("scess");
				scess.value=(Number(a87.value)+Number(surcharge.value))*0.01;
			
			//TOTAL TAX LIABILITY
			let totalLiability=document.getElementById("totalLiability");
				totalLiability.value=Number(a87.value)+Number(surcharge.value)+Number(ecess.value)+Number(scess.value)+Number(lotterytax.value);
	
}
