/**

        GESTION DE FICHIERS XML
        /!\ LES COMMENTAIRES SONT EN FRANCAIS POUR LE MOMENT
            A MODIFIER EN ANGLAIS PLUS TARD /!\
        *Importer le fichier sql: worknshare.sql


                                                            **/
#include <stdio.h>
#include <stdlib.h>
#include <winsock2.h>
#include <mysql.h>
#include <libxml/xmlmemory.h>
#include <libxml/xmlwriter.h>
#include <libxml/xmlreader.h>
#include <libxml/parser.h>
#include <dirent.h>
#include <time.h>

#include "header.h"

int main(int argc, char ** argv){

    Data          data;
    int           qrcode = 3; //QRCODE RECUPERE
    char          *xmlFileName; //FICHIER INTERMEDIAIRE
    const char    *xmlFileName2; //FICHIER XML MMJJ/openspace.xml
    const char    *xmlFinalFileName; //FICHIER XML JJ

    int           idlenght = 0;
    int           namelenght = 0;
    int           datelenght = 0;

    int           i = 0;
    char          mmaa[4];  //REPERTOIRE MMAA
    char          jj[2];    //NOM FICHIER XML JJ
    int           error = 0;
    //MYSQL
    MYSQL       *mysql;
    MYSQL_RES   *result = NULL;
    MYSQL_ROW   row;

    //XML
    xmlDocPtr       doc = NULL;

    //HEURE
    time_t t;
    struct tm instant;


    char request[150];
    mysql = mysql_init(NULL);
    mysql_options(mysql, MYSQL_READ_DEFAULT_GROUP, "option");

    /**             RECUPERATION DES INFORMATIONS UTILISATEURS DEPUIS LA
                            BASE DE DONNEES:
                                Sur localhost pour le moment                    **/

    if(mysql_real_connect(mysql, "127.0.0.1", "root","", "worknshare", 0, NULL, 0)){

        sprintf(request, "SELECT * FROM user WHERE idUser = \'%d\'", qrcode);
        mysql_query(mysql,request);
        result = mysql_use_result(mysql);
        while((row = mysql_fetch_row(result))){
            sprintf(data.idUser, "%s", row[0]);
            sprintf(data.name, "%s", row[1]);
            sprintf(data.surname, "%s", row[2]);
            sprintf(data.mail, "%s", row[3]);
        }
        sprintf(request, "SELECT * FROM booking WHERE idUser = \'%d\'", qrcode);

        mysql_query(mysql,request);
        result = mysql_use_result(mysql);
        while((row = mysql_fetch_row(result))){
            sprintf(data.idBooking, "%s", row[0]);
            sprintf(data.datetime, "%s", row[4]);
            sprintf(data.idOpenspace, "%s", row[2]);
            sprintf(data.state, "%s", row[7]);
        }

        sprintf(request, "SELECT * FROM openspace WHERE idOpenSpace = \'%s\'", data.idOpenspace);

        mysql_query(mysql,request);
        result = mysql_use_result(mysql);
        while((row = mysql_fetch_row(result))){
            sprintf(data.openspaceName, "%s", row[1]);
        }
        //RECUPERE LA TAILLE DES INFORMATIONS SUIVANTES:
        idlenght = strlen(data.idBooking);
        namelenght = strlen(data.openspaceName);
        datelenght = strlen(data.datetime);

        xmlFileName = malloc(sizeof(char) * (idlenght + namelenght + datelenght + 4));
        xmlFileName2 = malloc(sizeof(char) * (idlenght + namelenght + datelenght + 4));
        xmlFinalFileName = malloc(sizeof(char) * 5);


        //CREATION DU NOM DU FICHIER XML DE FORMAT: id:nom:date.xml
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
            printf("%c", xmlFileName[i]);
            i++;
        }

        sprintf(xmlFileName2, "%s.xml", xmlFileName);


        /**
                        CREATION DU FICHIER XML SOUS FORMAT:
                        idOpenspace:openspaceName:date.xml
                                                                        **/
        //VERIFIE SI LE FICHIER EXISTE DEJA
        error = readXMLFile(xmlFileName2);

        if(error == 0){ //SI LE FICHIER EXISTE DEJA, REECRITURE DU FICHIER
            doc = parseDoc(xmlFileName2, data);

        }else{ //SINON CREATION DU NOUVEAU FICHIER

            xmlWriterFilename(xmlFileName2, data, error);
            doc = parseDoc(xmlFileName2, data);
        }

        /**
                        APRES LA CREATION DU FICHIER XML
                            ENVOI DU FICHIER XML VERS LE SERVEUR SI
                                L'envoi des fichiers XML vers le Service Informatique s'effectura tous les 23:00
                            CONCATENATION DES FICHIERS
                            1. Vérifier si le fichier JJ unique existe
                                Si oui, on reprend le fichier et on ajoute
                                Si non, on créé le fichier et on ajoute

                                                                                **/
        error = checkHourBeforeSend(instant, t);
        browseXMLFiles();

        /*//RECUPERATION DU JOUR POUR LA CREATION DU FICHIER FINAL
        jj[0] = data.datetime[8];
        jj[1] = data.datetime[9];
        jj[2] = '\0';
        printf("JJ = %s", jj);
        sprintf(xmlFinalFileName, "%s.xml", jj); //RECUPERATION DU NOM DU FICHIER
        createDirectory(xmlFinalFileName, data); //CREATION DU REPERTOIRE DE FORMAT MMAA*/

        free(xmlFinalFileName);
        free(xmlFileName2);
        free(xmlFileName);


    }else{
        printf("\nCannot connect to the database");
    }
    xmlCleanupParser();
    xmlMemoryDump();

    return 0;
}
