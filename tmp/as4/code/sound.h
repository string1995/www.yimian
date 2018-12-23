#include<stdio.h>  /* Include standard library of stdio.h for the use of function printf(), get() */
#include<stdlib.h> /* Include standard liberary of stdlib.h for the use of function system(), */

/* function of playing background1 */
void sound__background1()
{
	/* stop music player */
	system("tasklist | find \"wscript.exe\" > nul && taskkill /f /im wscript.exe > nul ");
	/* play background via vbs */
 	system("copy scrpt\\snd_start_bc1.as2 snd_start_bc1.vbs>nul");
  	system("copy scrpt\\snd_bckgrnd1.as2 snd_bckgrnd1.vbs>nul");
	system("wscript snd_start_bc1.vbs");
	system("del snd_start_bc1.vbs>nul");


}

/* function of playing background2 */
void sound__background2()
{
	/* stop music player */
	system("tasklist | find \"wscript.exe\" > nul && taskkill /f /im wscript.exe > nul ");
	/* play background via vbs */
	system("copy scrpt\\snd_start_bc2.as2 snd_start_bc2.vbs>nul");
  	system("copy scrpt\\snd_bckgrnd2.as2 snd_bckgrnd2.vbs>nul");
	system("wscript snd_start_bc2.vbs");
	system("del snd_start_bc2.vbs>nul");

}

/* function of playing win */
void sound__win()
{
	/* play background via vbs */
	system("copy scrpt\\snd_start_wn.as2 snd_start_wn.vbs>nul");
  	system("copy scrpt\\snd_wn.as2 snd_wn.vbs>nul");
	system("wscript snd_start_wn.vbs");
	system("del snd_start_wn.vbs>nul");

}

/* function of playing draw */
void sound__draw()
{
	/* play background via vbs */
	system("copy scrpt\\snd_start_dr.as2 snd_start_dr.vbs>nul");
  	system("copy scrpt\\snd_drw.as2 snd_drw.vbs>nul");
	system("wscript snd_start_dr.vbs");
	system("del snd_start_dr.vbs>nul");


}

/* function of playing lose */
void sound__lose()
{
	/* play background via vbs */
	system("copy scrpt\\snd_start_ls.as2 snd_start_ls.vbs>nul");
  	system("copy scrpt\\snd_ls.as2 snd_ls.vbs>nul");
	system("wscript snd_start_ls.vbs");
	system("del snd_start_ls.vbs>nul");

}

/* function of playing allclear*/
void sound__allclear()
{
	/* stop music player */
	system("tasklist | find \"wscript.exe\" > nul && taskkill /f /im wscript.exe > nul ");
	/* play background via vbs */
	system("copy scrpt\\snd_start_al.as2 snd_start_al.vbs>nul");
  	system("copy scrpt\\snd_allclr.as2 snd_allclr.vbs>nul");
	system("wscript snd_start_al.vbs");
	system("del snd_start_al.vbs>nul");

}

/* function of playing gameover */
void sound__gameover()
{
	/* stop music player */
	system("tasklist | find \"wscript.exe\" > nul && taskkill /f /im wscript.exe > nul ");
	/* play background via vbs */
	system("copy scrpt\\snd_start_gm.as2 snd_start_gm.vbs>nul");
  	system("copy scrpt\\snd_gmvr.as2 snd_gmvr.vbs>nul");
	system("wscript snd_start_gm.vbs");
	system("del snd_start_gm.vbs>nul");

}

/* function of stop playing*/
void sound__stop()
{
	/* stop music player */
	system("tasklist | find \"wscript.exe\" > nul && taskkill /f /im wscript.exe > nul ");
	system("del snd_bckgrnd1.vbs>nul");
	system("del snd_bckgrnd2.vbs>nul");
	system("del snd_wn.vbs>nul");
	system("del snd_drw.vbs>nul");
	system("del snd_ls.vbs>nul");
	system("del snd_allclr.vbs>nul");
	system("del snd_gmvr.vbs>nul");
}