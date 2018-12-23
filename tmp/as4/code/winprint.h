
/* function for showing a msgbox window */
int winprint__msgbox(char msg[30], int type)
{
	/* declaer a FILE variable */
	FILE *fp=NULL;

	int nRtrnVal=0;

	/* make a new folder */
	system("IF NOT EXIST \"cache\" md cache >nul");

	/* write msg to msg.dat */
	fp = fopen ("cache/msg.dat", "w+");
	fprintf( fp,"%s",msg);

	/* close file */
	fclose(fp);

 	if(type==1)
 	{
 		system("copy scrpt\\prnt1.as2 prnt1.vbs>nul");
		/* include vb script */
		system("wscript prnt1.vbs");
		system("del prnt1.vbs>nul");

	
		nRtrnVal=1;
	}

	if(type==2)
	{
		 system("copy scrpt\\prnt2.as2 prnt2.vbs>nul");
		/* include vb script */
		system("wscript prnt2.vbs");
		system("del prnt2.vbs>nul");
		/* read result from res.dat */
		fp = fopen ("cache/res.dat", "r+");
		nRtrnVal=fgetc(fp)-48;

		/* close file */
		fclose(fp);
	}

	/* clear cache file */
	system("del /Q /F cache\\res.dat >nul");
	system("del /Q /F cache\\msg.dat >nul");


	return nRtrnVal;

}

