/*
Name: Assesment 3 of EEE 101

File Name: 1717608_3.c

Copyright: Free

Author: Yimian LIU (1717608)

Description: Program for providing a ONLINE Rock Paper Scissors Game.
 */

/* !!!!!!!!!!!Strongly Recommand to use gcc compiler!!!!!!!!!!!! */

#include<stdio.h>  /* Include standard library of stdio.h for the use of function printf(), get(),etc.*/
#include<stdlib.h> /* Include standard liberary of stdlib.h for the use of function system(),etc. */
#include<conio.h>  /* Include liberary of conio.h for the use of function */
#include <string.h>	/* Include string.h for the use of function strlen() ,etc.*/ 
#include <ctype.h>  /* Include ctype.h for the use of function isspace(),etc. */
#include <windows.h> /* lib for include windows API such as msgbox */
#include<time.h>	/* lib for getting system time */
#include <unistd.h> /* include this lib for multithread processing */
#include <pthread.h> /* include this lib for multithread processing */

/*****************declear global variables ********************/

/* var of user name */
char *g_pUsr=NULL;

/* declare usr play and win times */
int g_nTimes=-1,g_nWins=-1;

/* variable for win rate */
float g_fWin=-1;

/* variable state of bgm */
int snd=1;

/* indicate usr data items */
long lSize;

/*****************declear global variables ********************/



#define USRNAME_MAX_SIZE 25
#define USRPASSWORD_MAX_SIZE 50



/* declare structure */

typedef struct usr
{
	char name[USRNAME_MAX_SIZE];
	char passwd[USRPASSWORD_MAX_SIZE];
}usr;


/* declare functions for multithread processing */

void * interrupt_upload_data(void *);
void * interrupt_play_background_music2(void *);
void * interrupt_play_background_win(void *);
void * interrupt_play_background_draw(void *);
void * interrupt_play_background_lose(void *);
void * interrupt_play_background_allclear(void *);
void * interrupt_play_background_gameover(void *);
void * interrupt_insert_online_data(void *);


/* include personal lib*/

#include"winprint.h" /* Include self liberary of winprint.h for the use of printing a windows message */
#include"data.h"	/* Include self liberary of data.h for the use of deal with data */
#include"download.h" /* Include self liberary of download.h for updating and downloading data */
#include"input.h"  /* Include self liberary of input.h for dealing with user input */
#include"print.h"    /* Include self liberary of print.h for the use of printing dos picture */
#include"sound.h"    /* Include self liberary of sound.h for play a bgm*/




/* declare functions may use */

int menu();
int choose_play_times();
int choose_play_choice();
int play_mode(int mode);
char *chose_user();
void as1_exit();
int file_check();
void update_data_from_server();
int choose_settings();
int check_passwd(usr usr);
int create_passwd(usr usr);
int change_passwd(usr usr);


/* main function start */
int main(int argc, char *argv[])
{
	/* point which step to go */
	int stp=0,freshman=0;
	/* declare multithread*/
	pthread_t t0;


	/* check core file, if broken, reinstall */
	if(!file_check())
	{
		data__uninstall(1);
		exit(1);
	}

	/* check if connect to internet, if not exit */
	data__detect_internet();

	/* check core file, if not exist, download from server */
	if(file_check()==-1)
	{
		download__core_file();
	}


	/* start monitor event, for the purpose of kill bgm and delete tmp file after user exit */
	data__start_monitor(argv[0]);


	/* initialize the screen */
	print__setup();

	/* make sure data folder exist */
	system("IF NOT EXIST \"data\" md data >nul");

	/* update local data */
	download__get_online_usr();
	update_data_from_server();



	/*declear a usr struct */
	usr usr;


	while(1)
	{

/****************step:0::6 identity user section****************/

		while(stp==0||stp==6)
		{
			
			download__get_online_usr();
			download__get_online_password();
			/* display a waiting screen */
			print__wait(1);

			/* windows showing options for choosing an existed user */
			g_pUsr=chose_user();



			/* creat a new account if not exist */
			if(!g_pUsr)
			{
				int cmp=1;
				do
				{
					system("cls");
					g_pUsr=input__as1_input_name();

					char **pUsr=data__get_usr();

					int nUsrNum=data__get_usr_num(pUsr);
					cmp=0;
					/* check if usr exist*/
					for(int i=0;i<nUsrNum;i++)
						if(!strcmp(pUsr[i],g_pUsr))	cmp=1;

					if(cmp)	
					{
						printf("\n\nUser Already Exist!!\n");
						Sleep(3000);
					}

				}while(cmp);
				strcpy(usr.name,g_pUsr);

				/* create password*/
				if(!create_passwd(usr)) break;

				/* creat a tmp data for new user in order to avoid win rate unusual display*/
				int nTmp[3]={1,1,0};
				data__insert(g_pUsr,nTmp,0);

				int newUsrMark[3]={9,9,9};
				data__insert_online(newUsrMark);

				/* remark it's the first time login */
				freshman=1;

				/* showing a warning message for the first time login */
				char chWinmsg[]="This message is to inform you that the game will play a BGM!\nYou can Mute it in the setting menu.";
				winprint__msgbox(chWinmsg,1);
			}

			strcpy(usr.name,g_pUsr);

			if(!freshman) stp=check_passwd(usr);
			else	stp=1;
		}

/****************step:0::6 identity user section****************/


/****************step:1 menu section******************/

		while(stp==1)
		{
			/* reajust screen size because of screen size change in history section */
			system("mode con cols=88 lines=30");

			/* get user data */
			int **pData=data__get_data(g_pUsr);
			
			/* show a waiting screen */
			print__wait(1);

			/* update user win rate */
			g_fWin=data__win_rate(pData);

			/* play bgm */
			if(snd)
				sound__background1();

			/* navigate to selected section */
			stp=menu()+1;
		}

/****************step:1 menu section******************/

/****************step:2 game section******************/

		while(stp==2)
		{
			/* record game times */
			int nTms=choose_play_times();

			/* section of backing to main menu */
			if(nTms==6)
			{
				stp=1;
				break;
			}

    // 创建线程A
    if(pthread_create(&t0, NULL, interrupt_upload_data, NULL) == -1){
        puts("fail to create pthread t0");
        exit(1);
    }


			/* deal with first login situation, del tmp data */
			if(freshman==1)	
			{
				char chDos[20];
				sprintf(chDos,"del /Q data\\%s.dat",g_pUsr);
				system(chDos);
				freshman=0;
			}

			/* record playtimes and wintimes for display purpose*/
			g_nTimes=0;
			g_nWins=0;

			/* wait for the bgm to prepare*/
			print__wait(2);

			/* play game */
			play_mode(nTms);

			/* reset playtimes and wintimes */
			g_nTimes=-1;
			g_nWins=-1;

			stp=1;

		}

/****************step:2 game section******************/

/****************step:3 Rank section******************/

		while(stp==3)
		{

			/* get online data */
			download__get_online_usr();
			update_data_from_server();

			/* display rank */
			print__rank();

			/* when detect press esc, space, enter back to menu */
			if(input__detect_input_ASCII()==27||input__detect_input_ASCII()==32||input__detect_input_ASCII()==13)
				stp=1;

		}

/****************step:4 Rank section******************/

/****************step:4 history section******************/

		while(stp==4)
		{
			
			/* update local data */
			update_data_from_server();

			/* get user data */
			int **pData=data__get_data(g_pUsr);

			/* change windows size for display */
			char chDos[20];
			sprintf(chDos,"mode con cols=88 lines=%ld",lSize/3+18);
			system(chDos);

			/* print history */
			print__abstract_history(pData);

			/* when detect press esc, space, enter back to menu */
			if(input__detect_input_ASCII()==27||input__detect_input_ASCII()==32||input__detect_input_ASCII()==13)
				stp=1;

		}

/****************step:4 history section******************/

/****************step:5 setting section******************/

		while(stp==5)
		{
			/* get user selection */
			int nPnt=choose_settings();

			/* if user change sound state, do */
			if(nPnt==2) 
			{
				snd=!snd;
				if(snd==0) sound__stop();
			}

			/* if user choose to reinstall */
			if(nPnt==3) 
			{
				char winMsg[]="Are you sure to Reinstall?";

				if(winprint__msgbox(winMsg,2)==1)
				{
					sound__stop();
					data__uninstall(1);
				}
			}

			/* if user choose to uninstall */
			if(nPnt==4) 
			{
				char winMsg[]="Are you sure to Uninstall?";

				if(winprint__msgbox(winMsg,2)==1)
				{
					sound__stop();
					data__uninstall(0);

					exit(1);
				}
			}

			/* if user choose to resert password */
			if(nPnt==5) 
			{
				download__get_online_usr();
				download__get_online_password();
				change_passwd(usr);
			}


			/* if user choose to clean history */
			if(nPnt==6) 
			{
				data__clean(g_pUsr);
				update_data_from_server();
				/* get user data */
				int **pData=data__get_data(g_pUsr);
				g_fWin=data__win_rate(pData);
			}


			/* if user choose to back to menu */
			if(nPnt==1)
				stp=1;
		}

/****************step:5 setting section******************/

/****************step:7 exit section******************/

		while(stp==7)
		{
			/* display warming */
			char msg_exit[]="Are you sure to exit?";
			if(winprint__msgbox(msg_exit,2))
			{
				system("taskkill /f /im wscript.exe>nul");
				as1_exit();
			}
			else
				stp=1;	
		}

/****************step:7 exit section******************/

	}

	return 0;
}


/*functions for multithread processing */

void * interrupt_upload_data(void *a)
{
	int beginMark[3]={8,8,8};
	data__insert_online(beginMark);
    return NULL;
}

void * interrupt_play_background_music2(void *a)
{
	sound__background2();
    return NULL;
}

void * interrupt_play_background_win(void *a)
{
	sound__win();
    return NULL;
}

void * interrupt_play_background_draw(void *a)
{
	sound__draw();
    return NULL;
}

void * interrupt_play_background_lose(void *a)
{
	sound__lose();
    return NULL;
}

void * interrupt_play_background_allclear(void *a)
{
	sound__allclear();
    return NULL;
}

void * interrupt_play_background_gameover(void *a)
{
	sound__gameover();
    return NULL;
}

void * interrupt_insert_online_data(void *a)
{
	system("wscript data_online.vbs");
	system("del /Q data_online.vbs>nul");
    return NULL;
}


/* function for display menu */
int menu()
{
	int nVal=54;
	int nArrw=0;
	do
	{
		print__menu(nVal%6+1);

		nArrw= input__get_arrow();

		/* when input a arrow */
		if(nArrw==1||nArrw==-1)
			nVal+=nArrw;

		/* when press enter */
		if(nArrw==6)
			break;
		/* when press esc */
		if(nArrw==9)
			return 6;

	}while(1);

	return nVal%6+1;
}

/* screen for chosing a user */
char *chose_user()
{
	int nVal=54;
	int nArrw=0;

	char **pUsr=data__get_usr();

	int nUsrNum=data__get_usr_num(pUsr);

	if(nUsrNum==0)
	return NULL;

	do
	{
		print__user(nVal%(nUsrNum+1)+1);

		nArrw= input__get_arrow();

		/* when input a arrow */
		if(nArrw==1||nArrw==-1)
			nVal+=nArrw;

		/* when press enter */
		if(nArrw==6)
			break;

	}while(1);

	/* if creat a new usr, return NULL */
	if(nVal%(nUsrNum+1)==nUsrNum)
		return NULL;

	return pUsr[nVal%(nUsrNum+1)];
}

/* function for display play times */
int choose_play_times()
{
	int nVal=54;
	int nArrw=0;
	do
	{
		print__play_times(nVal%6+1);

		nArrw= input__get_arrow();

		/* when input a arrow */
		if(nArrw==1||nArrw==-1)
			nVal+=nArrw;

		/* when press enter */
		if(nArrw==6)
			break;
		/* when press esc */
		if(nArrw==9)
			return 6;

	}while(1);

	return nVal%6+1;
}



/* function for display play times */
int choose_play_choice()
{
	int nVal=54;
	int nArrw=0;

	do
	{
		print__play_choose(nVal%3+1);

		nArrw= input__get_arrow();

		/* when input a arrow */
		if(nArrw==1||nArrw==-1)
			nVal+=nArrw;

		/* when press enter */
		if(nArrw==6)
			break;
		/* when press esc */
		if(nArrw==9)
			return 6;

	}while(1);

	return nVal%3+1;
}


/* play games with mode */
int play_mode(int mode)
{
	int win=0,lose=0;
	int nCmp,nChc;
	int nRslt[3];
	char chWin[]="You Win!";
	char chLose[]="You Lose!";
	pthread_t t1;
	pthread_t t2;

	if(snd==1)
			pthread_create(&t1, NULL, interrupt_play_background_music2, NULL);

	while(win<mode&&lose<mode)
	{
		nRslt[0]=0;
		nRslt[1]=0;
		nRslt[2]=0;
		srand((int)time(0));
		nCmp=rand()%3+1;
		nChc=choose_play_choice();

		if(nChc==6)
			return 0;

		if(nChc==nCmp+1||(nChc==1&&nCmp==3))
		{
			nRslt[2]=1;
			win++;
			g_nWins++;
			if(snd==1) pthread_create(&t2, NULL, interrupt_play_background_win, NULL);

		}
		else if(nCmp==nChc+1||(nCmp==1&&nChc==3))
		{
			lose++;
			if(snd==1) pthread_create(&t2, NULL, interrupt_play_background_lose, NULL);
		}
		else
			if(snd==1) pthread_create(&t2, NULL, interrupt_play_background_draw, NULL);
		nRslt[0]=nChc;
		nRslt[1]=nCmp;

		data__insert(g_pUsr,nRslt,1);

		print__result(nChc,nCmp);

		g_nTimes++;

		Sleep(2000);

		fflush(stdin);

	}

	if(win==mode)
	{
		if(snd==1) pthread_create(&t1, NULL, interrupt_play_background_allclear, NULL);
		MessageBox( 0, chWin, "AS3 Message", 0 );
	}
	else
	{
		if(snd==1) pthread_create(&t1, NULL, interrupt_play_background_gameover, NULL);
		MessageBox( 0, chLose, "AS3 Message", 0 );
	}

return 1;

}

/* check file */
int file_check()
{
	
	if(!fopen("msc/gameover.mp3","r")) return -1;
	if(!fopen("msc/win.mp3","r")) return 0;
	if(!fopen("msc/lose.mp3","r")) return 0;
	if(!fopen("msc/draw.mp3","r")) return 0;
	if(!fopen("msc/background2.mp3","r")) return 0;
	if(!fopen("msc/background1.mp3","r")) return 0;
	if(!fopen("msc/allclear.mp3","r")) return 0;
	if(!fopen("scrpt/snd_wn.as2","r")) return 0;
	if(!fopen("scrpt/snd_start_wn.as2","r")) return 0;
	if(!fopen("scrpt/snd_start_ls.as2","r")) return 0;
	if(!fopen("scrpt/snd_start_gm.as2","r")) return 0;
	if(!fopen("scrpt/snd_start_dr.as2","r")) return 0;
	if(!fopen("scrpt/snd_start_bc2.as2","r")) return 0;
	if(!fopen("scrpt/snd_start_bc1.as2","r")) return 0;
	if(!fopen("scrpt/snd_start_al.as2","r")) return 0;
	if(!fopen("scrpt/snd_ls.as2","r")) return 0;
	if(!fopen("scrpt/snd_gmvr.as2","r")) return 0;
	if(!fopen("scrpt/snd_drw.as2","r")) return 0;
	if(!fopen("scrpt/snd_bckgrnd2.as2","r")) return 0;
	if(!fopen("scrpt/snd_bckgrnd1.as2","r")) return 0;
	if(!fopen("scrpt/snd_allclr.as2","r")) return 0;
	if(!fopen("scrpt/prnt2.as2","r")) return 0;
	if(!fopen("scrpt/prnt1.as2","r")) return 0;
	if(!fopen("scrpt/lstn.as2","r")) return 0;

	return 1;
}


/* screen for chosing a user */
void update_data_from_server()
{
	char **pUsr=data__get_usr();
	int i,nRows=data__get_usr_num(pUsr);

	for(i=0;i<nRows;i++)
		download__data(pUsr[i]);
}


/* function for display play times */
int choose_settings()
{
	int nVal=666;
	int nArrw=0;
	do
	{
		print__settings(nVal%6+1);

		nArrw= input__get_arrow();

		/* when input a arrow */
		if(nArrw==1||nArrw==-1)
			nVal+=nArrw;

		/* when press enter */
		if(nArrw==6)
			break;
		/* when press esc */
		if(nArrw==9)
			return 1;

	}while(1);

	return nVal%6+1;
}

/* exit */
void as1_exit()
{
	sound__stop();
	/* clean the screan */
	system("cls");

	printf("\n\n\n\n");

	int nSpc=30;
	/* print a 再见 with a heart */
	print__space(nSpc);
    printf("        **           **        \n");
    Sleep(70);	
    print__space(nSpc);
    printf("    *       *     *       *    \n");
    Sleep(70);	
    print__space(nSpc);
    printf("  *            *             *  \n");
    Sleep(70);	
    print__space(nSpc);
    printf(" *    _______      ____        * \n");
    Sleep(70);
    print__space(nSpc);
    printf(" *     __|__      |    |       * \n");
    Sleep(70);	
    print__space(nSpc);
    printf(" *    |__|__|     |  | |       * \n");
    Sleep(70);	
    print__space(nSpc);
    printf(" *   _|__|__|_    |  | |      * \n");
    Sleep(70);	
    print__space(nSpc);
    printf("  *   |     |       /|       *  \n");
    Sleep(70);	
    print__space(nSpc);
    printf("   *  |     |      /  \\__|  *   \n");
    Sleep(70);	
    print__space(nSpc);
    printf("    *                     *    \n");
    Sleep(70);	
    print__space(nSpc);
    printf("      *                 *      \n");
    Sleep(70);	
    print__space(nSpc);
    printf("        *             *        \n");
    Sleep(70);	
    print__space(nSpc);
    printf("          *         *          \n");
    Sleep(70);	
    print__space(nSpc);
    printf("             *   *             \n");
    Sleep(70);	
    print__space(nSpc);
    printf("               *               \n");

    Sleep(300);
    exit(0);
}


/*function for check password*/
int check_passwd(usr usr)
{
	int words=0,times=0;
	char tmp_word=0;

	while(1)
	{
		/* get password input*/
		while(1)
		{
			print__get_password(times,words);

			tmp_word=input__detect_input_ASCII();
			/* when press esc*/
			if(tmp_word==27) return 0;
			/* when press enter*/
			if(tmp_word==13) break;
			/* when press backpace<-*/
			if(tmp_word==8) 
			{
				if(words>0)
				{
					words--;
					usr.passwd[words]='\0';
				}
			}
			/* filter*/
			if(tmp_word>32&&tmp_word<127) 
			{
				usr.passwd[words]=tmp_word;
				words++;
				usr.passwd[words]='\0';
			}
		}


		char *key=NULL;
		int *ifPasswd=NULL;
		FILE *fp=NULL;

		fp=fopen("data/psswd.txt","r");
		char tmp[50];
		sprintf(tmp,"%s",data__encode_password(usr,key));
		/* check is passwd exist*/
		ifPasswd =data__seek_key_word(tmp, fp,ifPasswd);

		fclose(fp);
		/* if exist*/
		if(ifPasswd[0]) return 1;
		/* input time ++*/
		times++;
		/* reset*/
		tmp_word=0;
		words=0;
		/* if wrong for more than 5 times*/
		if(times>5)
		{
			system("cls&&color 4F");

			printf("\nPassword is wrong for more than 5 times!!  Program will quit in 2 Seconds!\n");
			Sleep(3000);

			exit(-1);
		}
	}

}


/* function for create password*/
int create_passwd(usr usr)
{

	int words=0,times=0;
	char tmp_word=0;
	char tmp_psswd[40];

	while(1)
	{
		usr.passwd[0]='\0';
		while(1)
		{
			print__get_newpassword(times,words);

			tmp_word=input__detect_input_ASCII();
			/* esc*/
			if(tmp_word==27) return 0;
			/* enter*/
			if(tmp_word==13) break;
			/*backspace*/
			if(tmp_word==8) 
			{
				if(words>0)
				{
					words--;
					usr.passwd[words]='\0';
				}
			}
			/* words*/
			if(tmp_word>32&&tmp_word<127) 
			{
				usr.passwd[words]=tmp_word;
				words++;
				usr.passwd[words]='\0';
			}

		}
		times++;
		words=0;
		tmp_psswd[0]='\0';
		/*get the passwd input again if it's legal*/
		while(!(usr.passwd[0]=='\0'||strlen(usr.passwd)<3||strlen(usr.passwd)>30))
		{
			print__get_newpassword(times,words);

			tmp_word=input__detect_input_ASCII();
			/* esc*/
			if(tmp_word==27) return 0;
			/* enter*/
			if(tmp_word==13) break;
			/*backspace*/
			if(tmp_word==8) 
			{
				if(words>0)
				{
					words--;
					tmp_psswd[words]='\0';
				}
			}

			if(tmp_word>32&&tmp_word<127) 
			{
				tmp_psswd[words]=tmp_word;
				words++;
				tmp_psswd[words]='\0';
			}

		}

		if(usr.passwd[0]=='\0')
		{
		
			system("cls");
			printf("Your password contains NOTHING!!!\n");
			Sleep(2500);

			times=-1;
		}

		else if(strlen(usr.passwd)<3||strlen(usr.passwd)>30)
		{
		
			system("cls");
			printf("Your password length should between 3 and 30!!!\n");
			Sleep(2500);

			times=-1;
		}

		else if(usr.passwd[0]!='\0'&&!strcmp(usr.passwd,tmp_psswd)) break;

		times++;
		words=0;
	}

	char *key=NULL;
	char tmp[50];

	sprintf(tmp,"%s",data__encode_password(usr,key));

	data__insert_psswd_online(tmp, tmp);

	return 1;
}


/*function for change password*/
int change_passwd(usr usr)
{

	int words=0,times=0;
	char tmp_word=0;
	char tmp[50];

	while(1)
	{
		while(1)
		{
			print__get_password(times,words);

			tmp_word=input__detect_input_ASCII();
			/* esc*/
			if(tmp_word==27) return 0;
			/*enter*/
			if(tmp_word==13) break;
			/*backspace*/
			if(tmp_word==8) 
			{
				if(words>0)
				{
					words--;
					usr.passwd[words]='\0';
				}
			}
			/*word*/
			if(tmp_word>32&&tmp_word<127) 
			{
				usr.passwd[words]=tmp_word;
				words++;
				usr.passwd[words]='\0';
			}
		}

		char *key=NULL;
		int *ifPasswd=NULL;
		FILE *fp=NULL;

		fp=fopen("data/psswd.txt","r");
		sprintf(tmp,"%s",data__encode_password(usr,key));
		ifPasswd =data__seek_key_word(tmp, fp,ifPasswd);

		fclose(fp);
		/*check password*/
		if(ifPasswd[0]) break;

		times++;
		tmp_word=0;
		words=0;
	}


	 words=0;
	 times=0;
	 tmp_word=0;

	char tmp_psswd[99];

	while(1)
	{
		usr.passwd[0]='\0';
		while(1)
		{
			print__get_newpassword(times,words);

			tmp_word=input__detect_input_ASCII();
			/*esc*/
			if(tmp_word==27) return 0;
			/*enter*/
			if(tmp_word==13) break;
			/*backspace*/
			if(tmp_word==8) 
			{
				if(words>0)
				{
					words--;
					usr.passwd[words]='\0';
				}
			}
			/*words*/
			if(tmp_word>32&&tmp_word<127) 
			{
				usr.passwd[words]=tmp_word;
				words++;
				usr.passwd[words]='\0';
			}
		}
		times++;
		words=0;
		while(!(usr.passwd[0]=='\0'||strlen(usr.passwd)<3||strlen(usr.passwd)>30))
		{
			print__get_newpassword(times,words);

			tmp_word=input__detect_input_ASCII();

			if(tmp_word==27) return 0;

			if(tmp_word==13) break;

			if(tmp_word==8) 
			{
				if(words>0)
				{
					words--;
					tmp_psswd[words]='\0';
				}
			}

			if(tmp_word>32&&tmp_word<127) 
			{
				tmp_psswd[words]=tmp_word;
				words++;
				tmp_psswd[words]='\0';
			}

		}

		if(usr.passwd[0]=='\0')
		{
			system("cls");
			printf("Your password contains NOTHING!!!\n");
			Sleep(2500);

			times=-1;
		}

		else if(strlen(usr.passwd)<3||strlen(usr.passwd)>30)
		{
			system("cls");
			printf("Your password length should between 3 and 30!!!\n");
			Sleep(2500);

			times=-1;
		}

		else if(usr.passwd[0]!='\0'&&!strcmp(usr.passwd,tmp_psswd)) break;
		times++;
		words=0;
	}

	char *key=NULL;
	char tmpp[50];

	sprintf(tmpp,"%s",data__encode_password(usr,key));

	data__insert_psswd_online(tmpp, tmp);

	return 1;
}
