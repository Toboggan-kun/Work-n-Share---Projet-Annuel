
#include "header.h"


void getValue(GtkWidget *widget, gpointer data){


    //MYSQL
    MYSQL         *mysql;
    MYSQL_RES     *result = NULL;
    MYSQL_ROW     row;

    char request[150];
    mysql = mysql_init(NULL);
    mysql_options(mysql, MYSQL_READ_DEFAULT_GROUP, "option");

    char    *id;
    char    dateTime[21];
    id = gtk_entry_get_text(GTK_ENTRY((char *)data));



    if(strlen(id) == 0){
        messageError(0);
        return 0;
    }else{

        if(mysql_real_connect(mysql, "127.0.0.1", "root","", "worknshare", 0, NULL, 0)){
            sprintf(request, "SELECT * FROM user WHERE idUser = \'%s\'", id);

            mysql_query(mysql, request);
            result = mysql_use_result(mysql);
            while((row = mysql_fetch_row(result))){

                if(strcmp(row[0], id) == 0){
                    printf("\nCet utilisateur existe.");
                    mysql_free_result(result);
                    sprintf(request, "SELECT * FROM booking WHERE idUser = \'%s\'", id);

                    mysql_query(mysql, request);
                    result = mysql_use_result(mysql);

                    while((row = mysql_fetch_row(result))){

                        if(strcmp(row[1], id) == 0){
                            printf("\nCet utilsateur a une reservation.");
                            mysql_free_result(result);
                            sprintf(request, "SELECT * FROM booking WHERE idUser = \'%s\'", id);
                            mysql_query(mysql, request);
                            result = mysql_use_result(mysql);

                            while((row = mysql_fetch_row(result))){

                                sprintf(dateTime, "%s", row[3]);
                                //OKprintf("f: %s", dateTime);
                                checkDateTime(instant, t, dateTime);
                                return 0;

                            }


                        }
                    }
                    messageError(3);
                    return 0;

                }
            }
            messageError(1);
            return 0;
        }
        messageError(5);

    }


    mysql_free_result(result);


}

void checkDateTime(struct tm instant, time_t t, char *otherDate){
    //DATETIME DE L'HEURE LOCALE
    int     hour;
    int     minute;
    int     year;
    int     month;
    int     day;

    //DATETIME RECUPERE DANS LA BASE DE DONNEES
    int     year2;
    int     month2;
    int     day2;
    int     hour2;
    int     minute2;

    int     i, length;
    time(&t);
    instant = *localtime(&t); //RECUPERE L'HEURE LOCALE

    hour = instant.tm_hour;
    minute = instant.tm_min;

    year = instant.tm_year+1900;

    month = instant.tm_mon+1;
    day = instant.tm_mday;

    printf("\n%d - %d - %d - / %d : %d ", year, month, day, hour, minute);

    char year3[4];
    printf("ok");
    printf("otherDate:%s", otherDate);
    /*for(i = 0; i < 4; i++){
        year3[i] = otherDate[i];
        printf("%c", year3[i]);
    }*/



}
