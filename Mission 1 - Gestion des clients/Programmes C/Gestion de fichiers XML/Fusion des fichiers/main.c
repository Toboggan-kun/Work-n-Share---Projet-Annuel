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

    Data          *data;
    int           qrcode = 3; //QRCODE RECUPERE
    char          *xmlFileName = "3PlaceItalie2018-02-19.xml"; //FICHIER INTERMEDIAIRE
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
    xmlDocPtr *doc = NULL;

    //HEURE
    time_t t;
    struct tm instant;


    char request[150];
    mysql = mysql_init(NULL);
    mysql_options(mysql, MYSQL_READ_DEFAULT_GROUP, "option");

    data = (Data*)malloc(sizeof(Data)); //ALLOCATION DE LA STRUCTURE
    xmlFinalFileName = malloc(sizeof(char) * 5);

    /**             RECUPERATION DES INFORMATIONS UTILISATEURS DEPUIS LA
                            BASE DE DONNEES:
                                Sur localhost pour le moment                    **/

    if(mysql_real_connect(mysql, "127.0.0.1", "root","", "worknshare", 0, NULL, 0)){



        /**
                        APRES LA CREATION DU FICHIER XML
                            ENVOI DU FICHIER XML VERS LE SERVEUR SI
                                L'envoi des fichiers XML vers le Service Informatique s'effectura tous les 23:00
                            CONCATENATION DES FICHIERS
                            1. Vérifier si le fichier JJ unique existe
                                Si oui, on reprend le fichier et on ajoute
                                Si non, on créé le fichier et on ajoute

                                                                                **/
        error = checkHourBeforeSend(instant, t); //A 23:00, LES FICHIERS SONT ENVOYES
        browseXMLFiles(); //LIS TOUS LES FICHIERS XML DE NOTRE REPERTOIRE
        readXMLFile(xmlFileName);
        getElementContent(xmlFileName, data);
        /**
                    APRES LA RECUPERATION DES INFORMATIONS DU FICHIER XML
                    CREATION DU FICHIER XML FINAL JJ DANS UN REPERTOIRE MMAA
                        VERIFIER SI LE FICHIER EXISTE DEJA
                            SI IL EXISTE, REECRITURE AVEC parseDoc()
                            SINON, CREATION DU FICHIER AVEC xmlWriterFilename()

                                                                                **/
        //RECUPERATION DU JOUR POUR LA CREATION DU FICHIER FINAL

        printf("\ndatatime: %s\n", data->datetime);
        jj[0] = data->datetime[8];
        printf("ll");
        jj[1] = data->datetime[9];
        jj[2] = '\0';
        printf("JJ = %s", jj);
        sprintf(xmlFinalFileName, "%s.xml", jj); //RECUPERATION DU NOM DU FICHIER

        printf("\nnom du fichier: %s\n", xmlFinalFileName);

        createDirectory(xmlFinalFileName, data);





    }else{
        printf("\nCannot connect to the database");
    }
    free(xmlFinalFileName);
    xmlCleanupParser();
    xmlMemoryDump();

    return 0;
}
