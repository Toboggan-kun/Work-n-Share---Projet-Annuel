/**

    GESTION DE FICHIERS XML
    /!\ LES COMMENTAIRES SONT EN FRANCAIS POUR LE MOMENT
        A MODIFIER EN ANGLAIS PLUS TARD /!\
    LES DIFFERENTES ETAPES

**/
#include <stdio.h>
#include <stdlib.h>
#include <winsock2.h>
#include <mysql.h>
#include <libxml/xmlmemory.h>
#include <libxml/xmlwriter.h>
#include <libxml/xmlreader.h>
#include <libxml/parser.h>
#include <libxml/xmlmemory.h>
#include "header.h"

int main(int argc, char ** argv){

    Data          data;
    int           qrcode = 2; //QRCODE RECUPERE
    char          *xmlFileName; //FICHIER INTERMEDIAIRE
    const char    *xmlFileName2;
    const char    *xmlFinalFileName;

    int           idlenght = 0;
    int           namelenght = 0;
    int           datelenght = 0;

    int           i = 0;
    char          mmaa[4];
    char          jj[2];

    //MYSQL
    MYSQL       *mysql;
    MYSQL_RES   *result = NULL;
    MYSQL_ROW   row;

    //XML
    xmlDocPtr *doc = NULL;
    xmlNode *root = NULL;


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
        }

        sprintf(request, "SELECT * FROM openspace WHERE idOpenSpace = \'%s\'", data.idOpenspace);

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
        xmlFinalFileName = malloc(sizeof(char) * 5);

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


        /**
                        CREATION DU FICHIER XML SOUS FORMAT:
                        idOpenspace:openspaceName:date.xml
                                                                        **/
        xmlWriterFilename(xmlFileName2, data, 0);

        /**
                        APRES LA CREATION DU FICHIER XML
                            CONCATENATION DES FICHIERS
                            1. Vérifier si le fichier JJ unique existe
                                Si oui, on reprend le fichier et on ajoute
                                Si non, on créé le fichier et on ajoute

                                                                        **/

        //Récupérer le jour JJ pour nommer le fichier XML après concaténation
        jj[0] = data.datetime[8];
        jj[1] = data.datetime[9];
        jj[2] = '\0';
        printf("JJ = %s", jj);
        createDirectory(data); //CREATION DU REPERTOIRE DE FORMAT MMAA
        sprintf(xmlFinalFileName, "%s.xml", jj);
        xmlWriterFilename(xmlFinalFileName, data, 1); //CREATION DU FICHIER FINAL (CONCATENATION)
        readXMLFile(xmlFinalFileName); //A TERMINER, VERIFICATION SI LE FICHIER EXISTE OU NON

        doc = parseDoc(xmlFinalFileName, data);
        if(doc != NULL) {
            xmlSaveFormatFile(xmlFinalFileName, doc, 0); //N'ECRASE PAS LE FICHIER LORS DE LA MODIFICATION
            xmlFreeDoc(doc);
        }

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
