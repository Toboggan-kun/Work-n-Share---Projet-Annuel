#include <stdio.h>
#include <stdlib.h>
#include <winsock.h>
#include <MYSQL/mysql.h>

/* Je mettrais mes codes en anglais mais les commentaires en français,
S'il faut traduire pour accorder avec les vôtres, je le ferais, demandez moi juste */

/* Nous pourrons utiliser cette fonction pour se connecter à la BDD */
int connectDb(MYSQL * mysql);
void closeDb(MYSQL * mysql);

int verifyMail(gchar * mail);
int verifyLogin(MYSQL * mysql, gchar * mail, gchar * pwd);
int verifyPwd(gchar * pwd);
void md5_hash (char * string, char * hash)

/*Fonctions */


int connectDb(MYSQL * mysql){

  mysql_init(&mysql);
  if(mysql_connect(mysql, DB_HOST, DB_USER, DB_PWD, DB_NAME, 0, NULL, 0)){
    printf("You are connected to the database\n\n");
    return 1;
  }else{
    printf("An error has occured, you're not connected to the database\n\n", );
    return 0;
  }
}

/* Et celle-ci pour la quitter */

void closeDb(MYSQL * mysql){
  mysql_close(&mysql);
}

/* Cette fonction servira à verifier l'adresse mail */

int verifyLogin(MYSQL * mysql, gchar * mail, gchar * pwd){
  int error = 0;

  printf("\n\n");

/* Mail */
  if (verifyMail(mail)){
      if(checkMail(mysql, mail)){
        printf("\nThis email effectively exist in the database, this user pass");
        //Essayer de changer this par le nom de l'user dans la BDD
      }else{
        printf("\n2. This email doesn't exist, this user shall not pass");
        error = 1;
      }
    }else{
      printf("\n1. There is something wrong with this email, please type one that exist");
      error = 1;
    }

    if (error == 0){
      printf("\n\n");

/* Password */
    if (verifyPwd(pwd)){
      if(checkPwd(mysql, mail, pwd)){
        printf("\nThe password is correct, this user pass.")
      }else{
        printf("\n2. The username or password you entered is incorrect.");
        error = 1;
      }
    }else{
      printf("\n1. The password is either too big or too small : ");
      error = 1;
    }
  }

if (error == 0) return 1;
return 0;
}

/* Mail */


int verifyMail(gchar * mail){
  int error;
  regex_t preg;
  /*const char *regex = "SELECT * FROM `users` WHERE `email` NOT REGEXP '^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$';"
  ou
  <?php
   preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email)
   ?>
   */
   if (regcomp(&re, pattern, REG_EXTENDED|REG_NOSUB) != 0) {
        r*eturn 0;      /* Report error. */
    }
    status = regexec(&re, string, (size_t) 0, NULL, 0);
    regfree(&re);
    if (error == 0) {
        return 0;      /* Matching password */
    }
    return 1;
}
