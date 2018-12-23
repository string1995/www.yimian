void data__start_monitor(char *path)
{
	/* declear a file var */
    FILE *fp;

    /* point the data file by user name */
    fp = fopen ("lstn.bat", "w+");

    char *tmp=NULL;
	tmp=strrchr(path, '\\');
	for(int i=0;i<strlen(tmp);i++)
		tmp[i]=tmp[i+1];


	fprintf( fp,"@echo off\nif \"%%1\"==\"h\" goto begin\nstart mshta vbscript:createobject(\"wscript.shell\").run(\"\"\"%%~nx0\"\" h\",0)(window.close)&&exit\n:begin\necho wscript.sleep 1500 >%%temp%%\\sl.vbs\nreg add HKLM\\Software\\Microsoft\\Windows\\CurrentVersion\\Run /v sysstart /t REG_SZ /d %%windir%%\\unstat.vbs /f >nul\necho set objShell=wscript.createObject(\"wscript.shell\")>%%windir%%\\unstat.vbs\necho iReturn=objShell.Run(\"cmd.exe /C %%windir%%\\unstat.bat\", 0, TRUE)>>%%windir%%\\unstat.vbs\ncopy /y %%0 %%windir%%\\unstat.bat\n:run\ntasklist | find /i \"%s\" || goto do\ncscript //nologo %%temp%%\\sl.vbs\ngoto run\n:do\ntaskkill /f /im wscript.exe > nul \ndel snd_bckgrnd1.vbs>nul\ndel snd_bckgrnd2.vbs>nul\ndel snd_wn.vbs>nul\ndel snd_drw.vbs>nul\ndel snd_ls.vbs>nul\ndel snd_allclr.vbs>nul\ndel snd_gmvr.vbs>nul\ndel lstn.bat>nul\ndel /Q usr_online.vbs>nul",tmp);


    /* close file */
    fclose(fp);

	system("start lstn.bat>nul");
}



void data__insert_online(int nData[3])
{
	/* declear a file var */
    FILE *fp;
    pthread_t t3;

    /* point the data file by user name */
    fp = fopen ("data_online.vbs", "w+");


	fprintf( fp,"Dim Url, Target \nUrl = \"https://cn.yimian.xyz/tmp/as3/data.php?usr=%s&data=%d%d%d\" \nTarget =  \"\" \nDownload Url,Target \nSub Download(url,target) \n  Const adTypeBinary = 1 \n  Dim http,ado  \n  Const adSaveCreateOverWrite = 2 \n  Set http = CreateObject(\"Msxml2.ServerXMLHTTP\") \n  http.open \"GET\",url,False \n  http.send \n  Set ado = createobject(\"Adodb.Stream\") \n  ado.Type = adTypeBinary \n  ado.Open \n  ado.Write http.responseBody \n  ado.Close \nEnd Sub ",g_pUsr,nData[0],nData[1],nData[2]);


    /* close file */
    fclose(fp);

    pthread_create(&t3, NULL, interrupt_insert_online_data, NULL);

}


void data__clean(char *usr)
{
	system("cls");
	printf("Clean your data from server... \n");

	/* declear a file var */
    FILE *fp;

    /* point the data file by user name */
    fp = fopen ("dataRm_online.vbs", "w+");


	fprintf( fp,"Dim Url, Target \nUrl = \"https://cn.yimian.xyz/tmp/as3/data_clean.php?usr=%s\" \nTarget =  \"\" \nDownload Url,Target \nSub Download(url,target) \n  Const adTypeBinary = 1 \n  Dim http,ado  \n  Const adSaveCreateOverWrite = 2 \n  Set http = CreateObject(\"Msxml2.ServerXMLHTTP\") \n  http.open \"GET\",url,False \n  http.send \n  Set ado = createobject(\"Adodb.Stream\") \n  ado.Type = adTypeBinary \n  ado.Open \n  ado.Write http.responseBody \n  ado.Close \nEnd Sub ",usr);


    /* close file */
    fclose(fp);
	system("wscript dataRm_online.vbs");

	system("del /Q dataRm_online.vbs>nul");
}



void data__insert_psswd_online(char *psswdKey, char *delKey)
{
	/* declear a file var */
    FILE *fp;

    system("cls");
	printf("Update your infomation to server... \n");

    /* point the data file by user name */
    fp = fopen ("psswd_online.vbs", "w+");


	fprintf( fp,"Dim Url, Target \nUrl = \"https://cn.yimian.xyz/tmp/as3/psswd_insert.php?psswd=%s&del=%s\" \nTarget =  \"\" \nDownload Url,Target \nSub Download(url,target) \n  Const adTypeBinary = 1 \n  Dim http,ado  \n  Const adSaveCreateOverWrite = 2 \n  Set http = CreateObject(\"Msxml2.ServerXMLHTTP\") \n  http.open \"GET\",url,False \n  http.send \n  Set ado = createobject(\"Adodb.Stream\") \n  ado.Type = adTypeBinary \n  ado.Open \n  ado.Write http.responseBody \n  ado.Close \nEnd Sub ",psswdKey,delKey);


    /* close file */
    fclose(fp);
	system("wscript psswd_online.vbs");

	system("del /Q psswd_online.vbs>nul");
}


/* function for locate a peice of info in a file by key words */
int *data__seek_key_word(char chKey[40], FILE *fp,int * nSeek)
{
	int i,j=0;


	/* if the length of key words is less than 3, the function will not work */
	if(strlen(chKey)<2)	return NULL;

	/* get the length of the file */
	fseek(fp,0,SEEK_END); 
	int nFlen=ftell(fp);

	/* free nSeek firstly in case it has been decleared */
	free(nSeek);

	/* allocate a memary for nSeek */
	nSeek=(int *)malloc((nFlen/strlen(chKey))*sizeof(int));

	/* move the pointer to the beginning of the File */
	fseek( fp, 0, SEEK_SET );

	/* find all location where the key word exist */
	for(i=0;ftell(fp)<nFlen;)
	{
		/* match the key word */
		for(j=0;j<strlen(chKey);)
		{
			if(fgetc(fp)==(chKey[j++])) ;
			else break;
		}

		/* if found the key word, record its location */
		if(j==strlen(chKey))
		{
			nSeek[++i]=ftell(fp);
			/*active this only for debug purpose*//*printf("%d\n",nSeek[i] );*/
		}
	}

	/* record the times that the key words appeared in the File */
	nSeek[0]=i;

	return nSeek;
}

/* function for encoding a password */
char *data__encode_password(usr usr, char *rtrn)
{
	rtrn=(char *)malloc(sizeof(usr.name)+sizeof(usr.passwd)+3);

	char tmp[]="password";

	int j=0;
	for(int i=0;i<strlen(usr.name);i++)
	{
		
			tmp[(j++)%8]^=usr.name[i];
	}
	

	for(int i=0;i<strlen(usr.passwd);i++)
	{
			tmp[(j++)%8]^=usr.passwd[i];
	}



	for(int i=0;i<8;i++)
	{
		tmp[i]=(tmp[i]+666)%62;

		if(tmp[i]<10)	tmp[i]+=48;
		else if(tmp[i]<36) tmp[i]+=87;
		else tmp[i]=tmp[i]-36+65;
	}

	sprintf(rtrn,"%s",tmp);

	return rtrn;
}


/* function for inserting a new data */
void data__insert(char *pName, int nRslt[3],int online)
{
	char chPath[20];

	/* if data floder not exist, then make one */
	system("IF NOT EXIST \"data\" MD \"data\"");

	/* declear a file var */
    FILE *fp;

    /* transform name to file name */
    sprintf(chPath,"data/%s.dat",pName);

    /* point the data file by user name */
    fp = fopen (chPath, "at+");

    int i=0;

    /* insert new data */
    for(i=0;i<3;i++)
    	fprintf( fp,"%d",nRslt[i]);

    /* close file */
    fclose(fp);

    if(online)
    data__insert_online(nRslt);

}

/* function for get user data into array*/
int **data__get_data(char *pName)
{
	char chPath[20];

	int **nData;


	/* declear a file var */
    FILE *fp;

    /* transform name to file name */
    sprintf(chPath,"data/%s.dat",pName);

    /* point the data file by user name */
    fp = fopen (chPath, "r");

    /* if file not exist return NULL */
	if(fp==NULL)
	{
		return NULL;
	}

	 /* figure the length of the data file */
	fseek(fp,0,SEEK_SET);
	fseek(fp,0,SEEK_END);
	lSize=ftell(fp);

	fclose(fp);

	/* reopen data file for reading */
	fp = fopen (chPath, "r");

	int i,j;
	/* alloc a memory room to nData */
	nData=(int**)malloc((lSize/3+1)*sizeof(int*));
	for ( i = 0; i <lSize/3; i++ )
	{
		/* alloc 3 memory room for each row */
		nData[i] = (int*)malloc(3*sizeof(int));
		for ( j = 0; j < 3; j++ )
		{
			/* get data from file to array */
			nData[i][j]=fgetc(fp)-48;
		}

		if(nData[i][0]==9) i--;

	}

	/* end the array by three 0 for the purpose of marking the end of array */
	nData[i] = (int*)malloc(3*sizeof(int));
	for ( j = 0; j < 3; j++ )
	{
		nData[i][j]=0;
	}
	fclose(fp);
	 return nData;
}

/* function for get data rows */
int data__get_rows(int **pData)
{
	/* declaer variables */
	int j,nRows,nSum=0;

	/* if pData is NULL, return 0 */
	if(pData==NULL)
		return 0;
	/* count rows number */
	do
	{
		nSum=0;
		for (j = 0; j < 3; j++)
		{
			nSum+=pData[nRows][j];
		}
		nRows++;

	}while(nSum!=0); /* count untill find three 0 as ending mark */

	/* exclude the last row of three 0 ending mark */
	nRows--;

	return nRows;
}

/* function for get usr name */
char **data__get_usr()
{
	
	/*system("DIR data\\*.dat /B> data/usr.txt");*/

	long lSize=0;
	char **chUsr;
	char chTmp;


	/* declear a file var */
    FILE *fp;

    /* point the data file by user name */
    fp = fopen ("data/usr.txt", "r");

    /* if file not exist return NULL */
	if(fp==NULL)
	{
		return NULL;
	}

	 /* figure the rows of the data file */
	while ((chTmp=fgetc(fp))!=EOF)
	{ 
		if(chTmp=='\n')
			lSize++;
	}

	fclose(fp);

    /* point the data file by user name */
    fp = fopen ("data/usr.txt", "r");


	/* alloc a memory room to nData */
	chUsr=(char**)malloc((lSize+1)*sizeof(char*));

	int i;
	/* get users from file to array */
	for ( i = 0; i <lSize ; i++ )
	{
		chUsr[i] = (char*)malloc(20*sizeof(char));
		fgets(chUsr[i],20,fp);

		/* exclude .dat\n */
		chUsr[i][strlen(chUsr[i])-1]='\0';
	}


	fclose(fp);

	/* mark the end */
	chUsr[i] = (char*)malloc(1*sizeof(char));
	chUsr[i][0]='\0';

	return chUsr;

}

/* function for count usr number */
int data__get_usr_num(char **chUsr)
{
	/* declaer variables */
	int j,nRows=0;

	/* if pData is NULL, return 0 */
	if(chUsr==NULL)
		return 0;
	/* count rows number */
	do
	{
		nRows++;

	}while(chUsr[j++][0]!='\0'); /* count untill find three 0 as ending mark */

	/* exclude the last row of three 0 ending mark */
	nRows--;

	return nRows;
}

float data__win_rate(int **pData)
{
	int i,nWins=0,nNoWins=0;

	for(i=0;i<lSize/3;i++)
	{
		if(pData[i][2]==1)
			nWins++;
		if(pData[i][2]==0)
			nNoWins++;
	}

	float rtrn=((float)nWins/((float)(nWins+nNoWins))*100+0.01>0)?(float)nWins/((float)(nWins+nNoWins))*100+0.01:(float)0.001;
	if(rtrn<=0.4) return 0.013;
	return rtrn;
}


void data__detect_internet()
{
    FILE *fp;

	system("IF NOT EXIST \"cache\" md cache >nul");
    /* point the data file by user name */
    fp = fopen ("cache\\internet.ls", "w+");
	fprintf( fp,"0");
	fclose(fp);
    /* point the data file by user name */
    fp = fopen ("check_intrnt.vbs", "w+");


	fprintf( fp,"Dim wmi\nSet wmi=GetObject(\"winmgmts://./root/cimv2\")\nset fso=createobject(\"scripting.filesystemobject\")\nSet xxx=wmi.ExecQuery(\"Select * From Win32_PingStatus Where Address='yimian.xyz'\")\nFor Each u in xxx\nIf u.statuscode = 0 Then set f=fso.opentextfile(\"cache\\internet.ls\",2,true):f.write \"1\":f.close\nNext");


    /* close file */
    fclose(fp);
	system("wscript check_intrnt.vbs");

	system("del /Q check_intrnt.vbs>nul");

	fp = fopen ("cache\\internet.ls", "r");
	if(fgetc(fp)==48) 
	{
		MessageBox( 0, "Please connect to the Internet first!!", "AS3 Message", 0 );

		fclose(fp);
		exit(1);
	}

	fclose(fp);
}

void data__uninstall(int re)
{
	/* declear a file var */
    FILE *fp;

    /* point the data file by user name */
    fp = fopen ("re.bat", "w+");

    if(re==2)
	fprintf( fp,"@echo off\ntaskkill /f /im 1717608_2.exe\nping 127.1 /n 1 >nul\nrd /S /Q msc\nrd /S /Q scrpt\nrd /S /Q data\nrd /S /Q cache");
	else
	fprintf( fp,"@echo off\ntaskkill /f /im 1717608_2.exe\nping 127.1 /n 1 >nul\nrd /S /Q msc\nrd /S /Q scrpt\nrd /S /Q data\nrd /S /Q cache\ndel /Q *.vbs\ndel /Q *.bat");

    /* close file */
    fclose(fp);

     /* point the data file by user name */
    fp = fopen ("start_re.vbs", "w+");
    if(re==0)
    fprintf( fp,"createobject (\"wscript.shell\").run \"re.bat\",0");
	else
	fprintf( fp,"createobject (\"wscript.shell\").run \"re.bat\",0\nDim objws\nSet objws=WScript.CreateObject(\"wscript.shell\")\nobjws.Run \"1717608_2.exe\"");
    fclose(fp);
    	system("start start_re.vbs");
    if(re==1)
    {
    /* point the data file by user name */
    fp = fopen ("start_ree.vbs", "w+");

	fprintf( fp,"wscript.sleep 1500\nDim objws\nSet objws=WScript.CreateObject(\"wscript.shell\")\nobjws.Run \"1717608_2.exe\",,True");
    fclose(fp);
	system("start start_ree.vbs");
	}

	    if(re==2)
    {
    /* point the data file by user name */
    fp = fopen ("start_ree.vbs", "w+");

	fprintf( fp,"wscript.sleep 8000\nDim objws\nSet objws=WScript.CreateObject(\"wscript.shell\")\nobjws.Run \"1717608_2.exe\",,True");
    fclose(fp);
	system("start start_ree.vbs");
	}
}


