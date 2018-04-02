
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
                                return 0;

                            }


                        }
                    }
                    messageError(3);
                    return 0;

                }
            }
            messageError(1);
        }
    }

    mysql_free_result(result);


}

void checkDateTime(struct tm instant, time_t t){
    int     hour;
    int     minute;
    int     year;
    int     month;
    int     day;



    time(&t);
    instant = *localtime(&t); //RECUPERE L'HEURE LOCALE



    hour = instant.tm_hour;
    minute = instant.tm_min;

    year = instant.tm_year;
    month = instant.tm_mon;
    day = instant.tm_mday;

    printf("%d", hour);


}
