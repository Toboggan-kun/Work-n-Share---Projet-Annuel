
#include <stdio.h>
#include <stdlib.h>
#include <winsock2.h>
#include <mysql.h>
#include <winsock2.h>
#include <libxml/encoding.h>
#include <libxml/xmlwriter.h>
#include <libxml/tree.h>
#include <curl.h>
#include "header.h"


int main(int argc, char ** argv){

    Data          data;
    int           qrcode = 2; //QRCODE RECUPERE
    char          *xmlFileName;
    const char    *xmlFileName2;
    int           idlenght = 0;
    int           namelenght = 0;
    int           datelenght = 0;
    int           i = 0;

    //SOCKET FTP
    SOCKET sock;
    SOCKADDR_IN sin;
    sin.sin_addr.s_addr	= inet_addr("127.0.0.1");
    sin.sin_family		= AF_INET;
    sin.sin_port		= htons(4148);
    sock = socket(AF_INET,SOCK_STREAM,0);
    bind(sock, (SOCKADDR *)&sin, sizeof(sin));

    //MYSQL
    MYSQL       *mysql;
    MYSQL_RES   *result = NULL;
    MYSQL_ROW   row;


    char request[150];
    mysql = mysql_init(NULL);
    mysql_options(mysql, MYSQL_READ_DEFAULT_GROUP, "option");

    if(mysql_real_connect(mysql, "127.0.0.1", "root","", "worknshare", 0, NULL, 0)){

        sprintf(request, "SELECT * FROM user WHERE idUser = \'%d\'", qrcode); ///!\

        //printf("\nqrcode = %s", qrcode);

        mysql_query(mysql,request);
        result = mysql_use_result(mysql);
        while((row = mysql_fetch_row(result))){

            sprintf(data.idUser, "%s", row[0]);
            sprintf(data.name, "%s", row[1]);
            sprintf(data.surname, "%s", row[2]);
            sprintf(data.mail, "%s", row[3]);

        }
        sprintf(request, "SELECT * FROM booking WHERE idUser = \'%d\'", qrcode); ///!\

        mysql_query(mysql,request);
        result = mysql_use_result(mysql);
        while((row = mysql_fetch_row(result))){
            sprintf(data.idBooking, "%s", row[0]);
            sprintf(data.datetime, "%s", row[4]);
            sprintf(data.idOpenspace, "%s", row[2]);

        }

        sprintf(request, "SELECT * FROM openspace WHERE idOpenSpace = \'%s\'", data.idOpenspace); ///!\

        mysql_query(mysql,request);
        result = mysql_use_result(mysql);
        while((row = mysql_fetch_row(result))){
            sprintf(data.openspaceName, "%s", row[1]);

        }

        idlenght = strlen(data.idBooking);
        namelenght = strlen(data.openspaceName);
        datelenght = strlen(data.datetime);

        xmlFileName = malloc(sizeof(char) * (idlenght + namelenght + datelenght + 4));
        xmlFileName2 = malloc(sizeof(char) * (idlenght + namelenght + datelenght + 4));

        for(i = 0; i < idlenght; i++){
            xmlFileName[i] = data.idBooking[i];
        }
        i = 0;
        for(i = 0; i <= namelenght; i++){
            xmlFileName[i+idlenght] = data.openspaceName[i];
        }
        i = 0;
        while(data.datetime[i] != ' '){
            xmlFileName[i+(idlenght+namelenght)] = data.datetime[i];
            i++;
        }

        sprintf(xmlFileName2, "%s.xml", xmlFileName);
        xmlWriterFilename(xmlFileName2, data);
        //createDirectory(data);

        free(xmlFileName2);
        free(xmlFileName);


    }else{
        printf("\nEchoue");
    }

    return 0;
}
