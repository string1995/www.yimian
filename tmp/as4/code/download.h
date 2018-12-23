


void download__creat_vbs(char chName[20])
{
	/* declear a file var */
    FILE *fp;

    /* point the data file by user name */
    fp = fopen ("download.vbs", "w+");

	fprintf( fp,"Dim Url, Target \nUrl = \"https://obs-3431.obs.myhwclouds.com/as3/%s\" \nTarget =  \"%s\" \nDownload Url,Target \nSub Download(url,target) \n  Const adTypeBinary = 1 \n  Dim http,ado  \n  Const adSaveCreateOverWrite = 2 \n  Set http = CreateObject(\"Msxml2.ServerXMLHTTP\") \n  http.open \"GET\",url,False \n  http.send \n  Set ado = createobject(\"Adodb.Stream\") \n  ado.Type = adTypeBinary \n  ado.Open \n  ado.Write http.responseBody \n  ado.SaveToFile target \n  ado.Close \nEnd Sub ",chName,chName);


    /* close file */
    fclose(fp);
	system("wscript download.vbs");

	system("del /Q download.vbs>nul");
}

void download__get_online_usr()
{
	/* declear a file var */
    FILE *fp;
    system("del /Q data\\usr.txt>nul");
    system("cls");
 	printf("Updating Local Data from Internet...\n");
    /* point the data file by user name */
    fp = fopen ("usr_online.vbs", "w+");

	fprintf( fp,"Dim Url, Target \nUrl = \"http://as3.tmp.yimian.xyz/usr.php\" \nTarget =  \"data/usr.txt\" \nDownload Url,Target \nSub Download(url,target) \n  Const adTypeBinary = 1 \n  Dim http,ado  \n  Const adSaveCreateOverWrite = 2 \n  Set http = CreateObject(\"Msxml2.ServerXMLHTTP\") \n  http.open \"GET\",url,False \n  http.send \n  Set ado = createobject(\"Adodb.Stream\") \n  ado.Type = adTypeBinary \n  ado.Open \n  ado.Write http.responseBody \n  ado.SaveToFile target \n  ado.Close \nEnd Sub ");


    /* close file */
    fclose(fp);

	system("wscript usr_online.vbs");

	system("del /Q usr_online.vbs>nul");
}


void download__get_online_password()
{
	/* declear a file var */
    FILE *fp;
    system("del /Q data\\psswd.txt>nul");
    system("cls");
 	printf("Updating Local Data from Internet...\n");
    /* point the data file by user name */
    fp = fopen ("psswd_online.vbs", "w+");

	fprintf( fp,"Dim Url, Target \nUrl = \"http://as3.tmp.yimian.xyz/psswd.php\" \nTarget =  \"data/psswd.txt\" \nDownload Url,Target \nSub Download(url,target) \n  Const adTypeBinary = 1 \n  Dim http,ado  \n  Const adSaveCreateOverWrite = 2 \n  Set http = CreateObject(\"Msxml2.ServerXMLHTTP\") \n  http.open \"GET\",url,False \n  http.send \n  Set ado = createobject(\"Adodb.Stream\") \n  ado.Type = adTypeBinary \n  ado.Open \n  ado.Write http.responseBody \n  ado.SaveToFile target \n  ado.Close \nEnd Sub ");


    /* close file */
    fclose(fp);

	system("wscript psswd_online.vbs");

	system("del /Q psswd_online.vbs>nul");
}

void download__data(char chName[20])
{
	/* declear a file var */
    FILE *fp;
    char chDos[30];

 	sprintf(chDos,"del /Q data\\%s.dat>nul",chName);

 	int nRnd=rand()%4;
 	char chSign[3];
 	if(nRnd==0)	strcpy( chSign,"\\");
  	if(nRnd==1)	strcpy(  chSign,"/");
   	if(nRnd==2)	strcpy( chSign,"-");
    if(nRnd==3)	strcpy( chSign,"|");
 	system("cls");
 	printf("Updating Local Data from Internet...  %s\n",chSign);
    system(chDos);
    /* point the data file by user name */
    fp = fopen ("data_online.vbs", "w+");

	fprintf( fp,"Dim Url, Target \nUrl = \"http://as3.tmp.yimian.xyz/data/%s.as2\" \nTarget =  \"data/%s.dat\" \nDownload Url,Target \nSub Download(url,target) \n  Const adTypeBinary = 1 \n  Dim http,ado  \n  Const adSaveCreateOverWrite = 2 \n  Set http = CreateObject(\"Msxml2.ServerXMLHTTP\") \n  http.open \"GET\",url,False \n  http.send \n  Set ado = createobject(\"Adodb.Stream\") \n  ado.Type = adTypeBinary \n  ado.Open \n  ado.Write http.responseBody \n  ado.SaveToFile target \n  ado.Close \nEnd Sub ",chName,chName);


    /* close file */
    fclose(fp);

	system("wscript data_online.vbs");

	system("del /Q data_online.vbs>nul");
}


void download__core_file()
{
	int nPrcnt=0;


	system("del /Q msc\\* >nul");
	system("del /Q scrpt\\* >nul");

	system("rd /Q msc >nul");
	system("rd /Q scrpt >nul");

	system("md msc>nul");
	system("md scrpt >nul");
	
	system("cls");
	printf("Download Necessary File from Server...  %d%%\n", nPrcnt);
	char f1[]="msc/gameover.mp3";
	nPrcnt+=3;
	download__creat_vbs(f1);
	nPrcnt+=10;

	system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f2[]="msc/win.mp3";
	download__creat_vbs(f2);
	nPrcnt+=6;

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f3[]="msc/lose.mp3";
	download__creat_vbs(f3);
	nPrcnt+=7;

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f4[]="msc/draw.mp3";
	download__creat_vbs(f4);
	nPrcnt+=5;

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f5[]="msc/background2.mp3";
	download__creat_vbs(f5);
	nPrcnt+=27;

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f6[]="msc/background1.mp3";
	download__creat_vbs(f6);
	nPrcnt+=24;

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f7[]="msc/allclear.mp3";
	download__creat_vbs(f7);
	nPrcnt+=1;

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f8[]="scrpt/snd_wn.as2";
	download__creat_vbs(f8);
	nPrcnt+=1;

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f9[]="scrpt/snd_start_wn.as2";
	download__creat_vbs(f9);
	nPrcnt+=1;

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f10[]="scrpt/snd_start_ls.as2";
	download__creat_vbs(f10);
	nPrcnt+=1;
	

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f11[]="scrpt/snd_start_gm.as2";
	download__creat_vbs(f11);
	nPrcnt+=1;
	

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f12[]="scrpt/snd_start_dr.as2";
	download__creat_vbs(f12);
	nPrcnt+=1;
	

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f13[]="scrpt/snd_start_bc2.as2";
	download__creat_vbs(f13);
	nPrcnt+=1;
	

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f14[]="scrpt/snd_start_bc1.as2";
	download__creat_vbs(f14);
	nPrcnt+=1;
	

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f15[]="scrpt/snd_start_al.as2";
	download__creat_vbs(f15);
	nPrcnt+=1;
	

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f16[]="scrpt/snd_ls.as2";
	download__creat_vbs(f16);
	nPrcnt+=1;
	

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f17[]="scrpt/snd_gmvr.as2";
	download__creat_vbs(f17);
	nPrcnt+=1;
	

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f18[]="scrpt/snd_drw.as2";
	download__creat_vbs(f18);
	nPrcnt+=1;
	

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f19[]="scrpt/snd_bckgrnd2.as2";
	download__creat_vbs(f19);
	nPrcnt+=1;
	

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f20[]="scrpt/snd_bckgrnd1.as2";
	download__creat_vbs(f20);
	nPrcnt+=1;
	

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f21[]="scrpt/snd_allclr.as2";
	download__creat_vbs(f21);
	nPrcnt+=1;
	

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f22[]="scrpt/prnt2.as2";
	download__creat_vbs(f22);
	nPrcnt+=1;
	

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f23[]="scrpt/prnt1.as2";
	download__creat_vbs(f23);
	nPrcnt+=1;
	

system("cls");
	printf("Download Necessary File from server...  %d%%\n", nPrcnt);
	char f24[]="scrpt/lstn.as2";
	download__creat_vbs(f24);
	nPrcnt+=1;
	



}