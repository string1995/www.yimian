
/* function for adjust window color, size and position */
void print__setup()
{
	system("TITLE EEE101 Assessment 3 BY Yimian LIU");	
	system("mode con cols=88 lines=30");
	system("color 0F");
}

void print__space(int nSpace)
{
	int i;
	for(i=0;i<nSpace;i++)
		printf(" ");
}

void print__wait(int nTm)
{
	int i;
	for(i=0;i<nTm;i++)
	{
		system("cls");
		printf("Please Wait... -\n");
		Sleep(150);

		system("cls");
		printf("Please Wait... \\\n");
		Sleep(150);

		system("cls");
		printf("Please Wait... |\n");
		Sleep(150);

		system("cls");
		printf("Please Wait... /\n");
		Sleep(150);

	}
	fflush(stdin);
}

/* display a header */
void print__header()
{
	time_t cur = time(NULL);

	struct tm *curtm = localtime(&cur);
	printf("%d-%d-%d %d:%d:%02d",curtm->tm_year+1900, curtm->tm_mon+1,curtm->tm_mday, curtm->tm_hour,curtm->tm_min, curtm->tm_sec);

	print__space(19);

	if(g_pUsr)
		printf("User: %6s",g_pUsr );

	if(g_nTimes!=-1)
		printf("           win: %d    Total times: %d ",g_nWins,g_nTimes);
	else if(g_fWin!=-1||g_fWin!=0)
		printf("                    Win Rate: %.2f%%",g_fWin-0.01+0.001);

	printf("\n----------------------------------------------------------------------------------------");
}

void print_item(char chItem[20],int nMrk,int nSpc)
{

	printf("\n\n");

	print__space(nSpc);

	printf("%11s",chItem );

	if(nMrk==1)
	{
		print__space(3);
		printf("<<--");
	}
}

void print__menu(int nPnt)
{


	/* clear screen */
	system("cls");

	print__header();

	printf("Please use Arrows on Keyboard to Choose:\n");
	char chItem1[]="New Game ";
	print_item(chItem1,(nPnt==1)?1:0,38);

	char chItem2[]="Rank   ";
	print_item(chItem2,(nPnt==2)?1:0,38);

	char chItem3[]="My History";
	print_item(chItem3,(nPnt==3)?1:0,38);

	char chItem4[]="Setting  ";
	print_item(chItem4,(nPnt==4)?1:0,38);

	char chItem5[]="Switch User";
	print_item(chItem5,(nPnt==5)?1:0,38);

	char chItem6[]="Exit Game";
	print_item(chItem6,(nPnt==6)?1:0,38);

	printf("\n\n\n\n\n\n\n\n\n\n\n\n\n");
	printf("Press ESC to Exit!");


}

void print__user(int nPnt)
{

	/* clear screen */
	system("cls");

	printf("Please choose your User Name:\n");
	char **pUsr=data__get_usr();
	int i,nRows=data__get_usr_num(pUsr);
	char chItem[]="Creat a new one!";

	for(i=0;i<nRows;i++)
		print_item(pUsr[i],(nPnt==i+1)?1:0,30);

	print_item(chItem,(nPnt==i+1)?1:0,30);



}

void print__play_times(int nPnt)
{


	/* clear screen */
	system("cls");

	print__header();
	printf("Choose Game Mode: \n");
	char chItem1[]="     one out of one sets match";
	print_item(chItem1,(nPnt==1)?1:0,25);

	char chItem2[]="    two out of three sets match";
	print_item(chItem2,(nPnt==2)?1:0,25);

	char chItem3[]="   three out of five sets match";
	print_item(chItem3,(nPnt==3)?1:0,25);

	char chItem4[]="   four out of seven sets match";
	print_item(chItem4,(nPnt==4)?1:0,25);

	char chItem5[]="   five out of nine sets match";
	print_item(chItem5,(nPnt==5)?1:0,25);

	char chItem6[]="            back to menu";
	print_item(chItem6,(nPnt==6)?1:0,25);

	printf("\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
	printf("Press ESC to Exit!");
}

void print__play_choose(int nPnt)
{


	/* clear screen */
	system("cls");

	print__header();

	printf("Please select your choice:\n\n");

	char chItem1[]="scissors";
	print_item(chItem1,(nPnt==1)?1:0,38);

	char chItem2[]="rock ";
	print_item(chItem2,(nPnt==2)?1:0,38);

	char chItem3[]="paper ";
	print_item(chItem3,(nPnt==3)?1:0,38);


	printf("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
	printf("Press ESC to Exit!");
}

void print_1_1()
{
	int nSpc=14;

	print__space(nSpc);
	printf("  ** **          **                    **          ** **     \n");	print__space(nSpc);
	printf("**     **     **                         **     **      **   \n");	print__space(nSpc);
	printf("   **      **                               **       **      \n");	print__space(nSpc);
	printf("       **  *                                 *  **           \n");	print__space(nSpc);
	printf("   **      **                               **       **      \n");	print__space(nSpc);
	printf("**     **     **                         **     **      **   \n");	print__space(nSpc);
	printf("  ** **          **                    **          ** **     \n");
}

void print_1_2()
{
	int nSpc=14;
	print__space(nSpc);
	printf("  ** **          **                        ***********   \n");	print__space(nSpc);
	printf("**     **     **                          *************  \n");	print__space(nSpc);
	printf("   **      **                            *************** \n");	print__space(nSpc);
	printf("       **  *                            *****************\n");	print__space(nSpc);
	printf("   **      **                            *************** \n");	print__space(nSpc);
	printf("**     **     **                          *************  \n");	print__space(nSpc);
	printf("  ** **          **                        ***********   \n");

	printf("\n\n");
	print__space(nSpc+25);
	printf("Unit Lost!");



}

void print_1_3()
{
	int nSpc=14;
	print__space(nSpc);
	printf("  ** **          **                     ++++++++++++++++\n");	print__space(nSpc);
	printf("**     **     **                        ++++++++++++++++\n");	print__space(nSpc);
	printf("   **      **                           ++++++++++++++++\n");	print__space(nSpc);
	printf("       **  *                            ++++++++++++++++\n");	print__space(nSpc);
	printf("   **      **                           ++++++++++++++++\n");	print__space(nSpc);
	printf("**     **     **                        ++++++++++++++++\n");	print__space(nSpc);
	printf("  ** **          **                     ++++++++++++++++\n");

	
	printf("\n\n");
	print__space(nSpc+28);
	printf("Win!");

}

void print_2_2()
{
	int nSpc=14;
	print__space(nSpc);
	printf("   ***********                             ***********   \n");	print__space(nSpc);
	printf("  *************                           *************  \n");	print__space(nSpc);
	printf(" ***************                         *************** \n");	print__space(nSpc);
	printf("*****************                       *****************\n");	print__space(nSpc);
	printf(" ***************                         *************** \n");	print__space(nSpc);
	printf("  *************                           *************  \n");	print__space(nSpc);
	printf("   ***********                             ***********   \n");
}

void print_2_1()
{
	int nSpc=14;
	print__space(nSpc);
	printf("   ***********                          **          ** **     \n");	print__space(nSpc);
	printf("  *************                           **     **      **   \n");	print__space(nSpc);
	printf(" ***************                             **       **      \n");	print__space(nSpc);
	printf("*****************                              *  **          \n");	print__space(nSpc);
	printf(" ***************                             **       **      \n");	print__space(nSpc);
	printf("  *************                           **     **      **   \n");	print__space(nSpc);
	printf("   ***********                          **          ** **     \n");

	printf("\n\n");
	print__space(nSpc+28);
	printf("Win!");

}

void print_2_3()
{
	int nSpc=14;
	print__space(nSpc);
	printf("   ***********                          ++++++++++++++++\n");	print__space(nSpc);
	printf("  *************                         ++++++++++++++++\n");	print__space(nSpc);
	printf(" ***************                        ++++++++++++++++\n");	print__space(nSpc);
	printf("*****************                       ++++++++++++++++\n");	print__space(nSpc);
	printf(" ***************                        ++++++++++++++++\n");	print__space(nSpc);
	printf("  *************                         ++++++++++++++++\n");	print__space(nSpc);
	printf("   ***********                          ++++++++++++++++\n");

	
	printf("\n\n");
	print__space(nSpc+25);
	printf("Unit Lost!");
}

void print_3_3()
{	
	int nSpc=14;
	print__space(nSpc);
	printf("++++++++++++++++                       ++++++++++++++++\n");	print__space(nSpc);
	printf("++++++++++++++++                       ++++++++++++++++\n");	print__space(nSpc);
	printf("++++++++++++++++                       ++++++++++++++++\n");	print__space(nSpc);
	printf("++++++++++++++++                       ++++++++++++++++\n");	print__space(nSpc);
	printf("++++++++++++++++                       ++++++++++++++++\n");	print__space(nSpc);
	printf("++++++++++++++++                       ++++++++++++++++\n");	print__space(nSpc);
	printf("++++++++++++++++                       ++++++++++++++++\n");
}

void print_3_1()
{	
	int nSpc=14;
	print__space(nSpc);
	printf("++++++++++++++++                       **          ** **     \n");	print__space(nSpc);
	printf("++++++++++++++++                         **     **      **   \n");	print__space(nSpc);
	printf("++++++++++++++++                            **       **      \n");	print__space(nSpc);
	printf("++++++++++++++++                              *  **          \n");	print__space(nSpc);
	printf("++++++++++++++++                            **       **      \n");	print__space(nSpc);
	printf("++++++++++++++++                         **     **      **   \n");	print__space(nSpc);
	printf("++++++++++++++++                       **          ** **     \n");

	
	printf("\n\n");
	print__space(nSpc+25);
	printf("Unit Lost!");
}
void print_3_2()
{	
	int nSpc=14;
	print__space(nSpc);
	printf("++++++++++++++++                           ***********    \n");	print__space(nSpc);
	printf("++++++++++++++++                          *************   \n");	print__space(nSpc);
	printf("++++++++++++++++                         ***************  \n");	print__space(nSpc);
	printf("++++++++++++++++                        ***************** \n");	print__space(nSpc);
	printf("++++++++++++++++                         ***************  \n");	print__space(nSpc);
	printf("++++++++++++++++                          *************   \n");	print__space(nSpc);
	printf("++++++++++++++++                           ***********    \n");

	printf("\n\n");
	print__space(nSpc+28);
	printf("Win!");

}


void print__result(int nChc,int nCmp)
{

	int nPnt=nChc;
	/* clear screen */
	system("cls");

	print__header();
	printf("Please select your choice:\n\n");

	char chItem1[]="scissors";
	print_item(chItem1,(nPnt==1)?1:0,38);

	char chItem2[]="rock ";
	print_item(chItem2,(nPnt==2)?1:0,38);

	char chItem3[]="paper ";
	print_item(chItem3,(nPnt==3)?1:0,38);
	printf("\n\n\n");

	if(nChc==1&&nCmp==1) print_1_1();
	if(nChc==1&&nCmp==2) print_1_2();
	if(nChc==1&&nCmp==3) print_1_3();
	if(nChc==2&&nCmp==1) print_2_1();
	if(nChc==2&&nCmp==2) print_2_2();
	if(nChc==2&&nCmp==3) print_2_3();
	if(nChc==3&&nCmp==1) print_3_1();
	if(nChc==3&&nCmp==2) print_3_2();
	if(nChc==3&&nCmp==3) print_3_3();

	printf("\n\n\n\n\n");
	printf("Press ESC to Exit!");

}

void print__history(int **pData)
{
	/* clear screen */
	system("cls");

	print__header();

	printf("\n\n");

	int nSpc=33;

	print__space(4);
	printf("Me");
	print__space(nSpc);
	printf("Computer");
	print__space(nSpc);
	printf("Result");

	printf("\n");

	int i;


	for(i=0;i<lSize/3;i++)
	{
		printf("\n");

		if(pData[i][0]==8)
		{
			printf("  ------------------------------------------------------------------------------------  ");
		}
		else
		{
		print__space(2);
		
		if(pData[i][0]==1) printf("scissor");
		if(pData[i][0]==2) printf(" rock  ");
		if(pData[i][0]==3) printf(" paper ");

		print__space(nSpc);

		if(pData[i][1]==1) printf("scissor");
		if(pData[i][1]==2) printf(" rock  ");
		if(pData[i][1]==3) printf(" paper ");

		print__space(nSpc);

		if(pData[i][2]==0) 
			{
				if(pData[i][0]==pData[i][1]) printf("Draw");
				else printf("Lose");
			}
		if(pData[i][2]==1) printf("Win");
		}

	}

		printf("\n\n");
	printf("Press ESC to Exit!");

}



void print__abstract_history(int **pData)
{
	/* clear screen */
	system("cls");

	print__header();

	printf("\n\n");

	int nSpc=33;

	print__space(4);
	printf("Me");
	print__space(nSpc);
	printf("Computer");
	print__space(nSpc);
	printf("Result");

	printf("\n");

	int i,roundTimes=0;


	for(i=0;i<lSize/3;)
	{
		printf("\n");

		while(pData[i++][0]==8&&i<lSize/3)
		{
			int j=i;
			while(pData[j][0]!=8&&j++<(lSize/3-2));

			printf("\n   No. %d",++roundTimes );

			printf("    Play rounds: %d",j-i );

			int win=0;

			for(int m=i;m<j;m++)
				win+=pData[m][2];

			printf("    Overal Win %d",win );

			int draw=0;

			for(int m=i;m<j;m++)
				if(pData[m][0]==pData[m][1])
					draw++;

			printf("   Draw: %d",draw );


			printf("   Lose: %d", j-i-win-draw);

			if(win>j-i-win-draw) printf("   Winner: The Player\n");
			else if(win<j-i-win-draw) printf("   Winner: The Computer\n");
			else printf("   Winner: No Winner\n");

		printf("  ------------------------------------------------------------------------------------  ");
		}
		
		i--;
		print__space(2);
		
		if(pData[i][0]==1) printf("scissor");
		if(pData[i][0]==2) printf(" rock  ");
		if(pData[i][0]==3) printf(" paper ");

		print__space(nSpc);

		if(pData[i][1]==1) printf("scissor");
		if(pData[i][1]==2) printf(" rock  ");
		if(pData[i][1]==3) printf(" paper ");

		print__space(nSpc);

		if(pData[i][2]==0) 
			{
				if(pData[i][0]==pData[i][1]) printf("Draw");
				else printf("Lose");
			}
		if(pData[i][2]==1) printf("Win");
		
		i++;
	}

		printf("\n\n");
	printf("Press ESC to Exit!\n\n");

}




void print__rank()
{
	/* clear screen */
	system("cls");

	print__header();

	printf("\n\n");

	int nSpc=33;

	print__space(4);
	printf("No.");
	print__space(nSpc);
	printf(" User  ");
	print__space(nSpc-3);
	printf("Win Rates");

	printf("\n");




	char **pUsr=data__get_usr();
	int i,j,nRows=data__get_usr_num(pUsr);
	float fRank[nRows][4];


	for(i=0;i<nRows;i++)
	{
		int **pData=data__get_data(pUsr[i]);

		fRank[i][1]= data__win_rate(pData);
		fRank[i][2]= data__win_rate(pData);

		fRank[i][0]= i;
	
	}

	int max=0,maxItm=0;

for(j=0;j<nRows;j++)
{

	for(i=0;i<nRows;i++)
	{
		if(fRank[i][2]>=max)
		{
			max=fRank[i][2];

			maxItm=i;

		}
	}

	fRank[maxItm][3]=j;

if(max)
{

		printf("\n");
		
		print__space(4);
		
		printf("%2d", j+1);

		print__space(nSpc-3);

		printf("%10s",pUsr[maxItm] );

		print__space(nSpc-1);

		if(fRank[maxItm][1]==0) printf("  0.00%%");
		else 
		printf("%3.2f%%", fRank[maxItm][1]-0.0099);
	fRank[maxItm][2]=0;
	max=0;
}
}
	

		printf("\n\n");
	printf("Press ESC to Exit!");

}


void print__settings(int nPnt)
{


	/* clear screen */
	system("cls");

	print__header();

	char chItem1[]="      Go Back to main menu";
	print_item(chItem1,(nPnt==1)?1:0,25);

	if(snd==1)
	{
	char chItem2[]="       Mute the sound";
	print_item(chItem2,(nPnt==2)?1:0,25);
	}
	else
	{
	char chItem3[]="       Open the sound";
	print_item(chItem3,(nPnt==2)?1:0,25);
	}
	char chItem4[]="      Reinstall the Game";
	print_item(chItem4,(nPnt==3)?1:0,25);

	char chItem5[]="      Uninstall the Game";
	print_item(chItem5,(nPnt==4)?1:0,25);

	char chItem6[]="      Change My Password";
	print_item(chItem6,(nPnt==5)?1:0,25);

	char chItem7[]="       Clean My History ";
	print_item(chItem7,(nPnt==6)?1:0,25);

	printf("\n\n\n\n\n\n\n\n\n\n\n\n\n");
	printf("Press ESC to Exit!");
}


void print__get_password(int type, int words)
{
	system("cls");

	if(type)	printf("Your password is WRONG! Please try again~\n\n");

	printf("Please input your password: \n\nYour password = ");

	for(int i=0;i<words;i++) printf("*");

	
}


void print__get_newpassword(int type, int words)
{
	system("cls");

	if(type%4==0)	printf("Please set your password: \n\nYour password = ");

	if(type%4==1)	printf("Please input your password again: \n\nYour password = ");

	if(type%4==2)	printf("The passwords you input are not the same!\n\nPlease set your password again: \n\nYour password = ");

	if(type%4==3)	printf("Please input your password again: \n\nYour password = ");

	for(int i=0;i<words;i++) printf("*");
}