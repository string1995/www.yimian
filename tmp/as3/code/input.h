#define LARGEST_DYNAMIC_MEMORY 65535	/* define the largest memory for a str in as1_getchar_plus function */

/* function for detect the keyborad to wait for a keyboard event and return it with ASCII */
int input__detect_input_ASCII()
{
	int nKey;

	/* clear former cache */
	fflush(stdin);

	/* get key value */
    nKey = _getch();

    return nKey;
}

/* function for get arrow event */
int input__get_arrow()
{
	int nVal=0;

	while(1)
	{
		nVal=input__detect_input_ASCII();

		if(nVal==224)
		{
			/* get arraw value */
			int nKey=input__detect_input_ASCII();

			if(nKey==75)
				return -1;
			if(nKey==77)
				return 1;
			if(nKey==72)
				return -1;
			if(nKey==80)
				return 1;
			else
				return 0;
		}

		if(nVal==13)
			return 6;
		if(nVal==27)
			return 9;
	}
}

/* function to get a char type string as needed */
char *input__as1_getchar_plus(char *p)
{

    char *pTmp;

    /* apply for a large dynamic memory for the first time storage */
    if((pTmp=(char *)malloc(LARGEST_DYNAMIC_MEMORY))==NULL)
    {
        printf("Application memory failure...\n");
        exit(0); /* if fail, exit the input__as1_getchar_plus function with the return value of 0 */
    }

    /* get words from keyboard to pTemp */
    gets(pTmp);

    /* apply for a dynamic memory as needed */
    if((p=(char *)malloc(strlen(pTmp)+1))==NULL)
    {
        printf("Application memory failure...\n");
        exit(0); /* if fail, exit the input__as1_getchar_plus function with the return value of 0 */
    }

    /* copy str from pTmp to p */
    strcpy(p,pTmp);

    /* free the Tmp memory */
    free(pTmp);

    return p;
}


/* function for process space, (remove begining space(1), convert middle multi-space into one space(1) remove middle space(2), remove ending space(1), *string) */
char *input__as1_process_space(int nStrt, int nMdd, int nEnd, char *str)
{
	int i,pston,iTmp;

	/* process the begining space */
	if(nStrt==1)
	{
		i=-1;
		/* figure the first not space char position */
		while(isspace(str[++i]));

		/* move the not space char to the begining */
		for(pston=i;pston<strlen(str);pston++)
			str[pston-i]=str[pston];

		/* give a stop sign at the end of the new char */
		str[pston-i]='\0';
		
	}

	/* process the ending space */
	if(nEnd==1)
	{
		i=0;
		/* figure the last not space char position */
		while(isspace(str[strlen(str)-(++i)]));

		/* give a stop sign at the end of the new char */
		str[strlen(str)-i+1]='\0';
		
	}

	/* process the middle space::combine */
	if(nMdd==1)
	{
		i=0;
		
		do
		{
			/* find the first space position */
			while(!isspace(str[i++])&&str[i]!='\0');

			/* deal with situation that there are one more spaces */
			if(isspace(str[i]))
			{
			/* storage the first space position in pston */
			pston=i;

			/* storage the process position to iTmp */
			iTmp=i;

			/* find the end of this space */
			while(isspace(str[++i]));

			/* move the left not space string to the second position of the space */
			for(;i<strlen(str);)
				str[pston++]=str[i++];

			/* give a new end of the processed string */
			str[pston]='\0';

			/* the process position give back to i */
			i=iTmp;

			}

		}
		while(i<strlen(str));	/* process the whole string to combine the multi space to single space */

	}


/* process the middle space::remove */
	if(nMdd==2)
	{
		i=0;
		
		do
		{
			/* find the first space position */
			while(!isspace(str[i++])&&str[i]!='\0');

			/* deal with the situation that there is no space anymore */
			if(str[i]=='\0')
				break;

			/* storage the first space position in pston */
			pston=i;

			/* storage the process position to iTmp */
			iTmp=i;

			/* find the end of this space */
			while(isspace(str[++i]));

			/* move the left not space string to the second position of the space */
			for(;i<strlen(str);)
				str[pston++-1]=str[i++];

			/* give a new end of the processed string */
			str[pston-1]='\0';

			/* the process position give back to i */
			i=iTmp;

		}
		while(i<strlen(str));	/* process the whole string to combine the multi space to single space */

	}

	return str;
}

/* figure out if the input value is  English(with space and num) or Numbers ::type : num(n), char(c),float(f)::return value{success: 1,fail: 0, error:2} */
int input__as1_jdge_var(char type,char *str)
{
	/* check if the char follow the type one by one */
	int i;
	for (i = 0; i < strlen(str); i++)
	{
		
		switch(type)
		{
			/* if exist not char, exit with 0 */
			case 'c':
			if(!(((int)str[i]>96&&(int)str[i]<123)||(str[i]>64&&str[i]<91)||((int)str[i]>47&&(int)str[i]<58)))
				return 0;
			break;

			/* if exist not num, exit with 0 */
			case 'n':
			if(!((int)str[i]>47&&(int)str[i]<58))
				return 0;
			break;

			/* if exist not float, exit with 0 */
			case 'f':
			if(!(((int)str[i]>47&&(int)str[i]<58)||(int)str[i]==46/* include '.' */))
				return 0;
			break;

			/* other error condition */
			default:
			return 2;
		}

	}

	return 1;
}

char *input__replace_space_with__(char *str)
{
	/* check if the char follow the type one by one */
	int i;
	for (i = 0; i < strlen(str); i++)
	{
		if((int)str[i]==32) str[i]=95;
	}

	return str;
}

/* function for input and check a name */
char *input__as1_input_name()
{

	char *pName=NULL;

	/* preload the state as 0, and clear a var rtrnVal to storage the return value of sub function */
	int state=0, rtrnVal=0;


	printf("Please input your English User Name...\nUser Name=");

	/* while the state is 0(false), loop the input process */
	do
	{
		/* input a name */
		pName=input__as1_getchar_plus(pName);

		/* process the start, middle, end space of input */
		pName=input__as1_process_space(1,0,1,pName);

		/* judge if the name is pure English */
		rtrnVal=input__as1_jdge_var('c',pName);

		/* replace space with _ */
		pName=input__replace_space_with__(pName);

		/* flase situation | the input is not pure*/
		if(!rtrnVal)
			printf("\nPlease input an ENGLISH Name!!!\n\nTry Again~\nPlease input your name...\nname=");

		/* success situation */
		else if(rtrnVal==1)
		{
			/* exclude the situation of empty input */
			if(!strlen(pName))
				printf("\nIllegal Empty Input!\n\nTry Again~\nPlease just try to type in something...\nname=");

			else if(strlen(pName)>0&&strlen(pName)<3)
				printf("\nToo less Input!\n\nTry Again~\nPlease just try to type in more than two characters...\nname=");

			else if(strlen(pName)>10)
				printf("\nYour name is too long!\n\nTry Again~\nPlease just try to type in less than TEN characters...\nname=");
			/* success */
			else
			state=1;
		}

		/* the other inner function error situation */
		else if(rtrnVal==2)
			printf("\nError with Function input__as1_jdge_var!\nPlease Connect Yimian LIU!!");


	}while(state==0);

	return pName;
}

