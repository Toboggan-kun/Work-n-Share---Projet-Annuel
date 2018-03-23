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

void xmlWriterFilename(const char *uri, Data *data, int setFlag){

    xmlTextWriterPtr    writer;

    writer = xmlNewTextWriterFilename(uri, 0);
    if(writer == NULL) {
        printf("xmlWriterFilename: Error creating the xml writer\n");
        return;
    }
    if(setFlag == 1){
        xmlTextWriterStartDocument(writer, NULL, "UTF-8", NULL);
        xmlTextWriterStartElement(writer, BAD_CAST "customers");
    }else{
        xmlTextWriterStartElement(writer, BAD_CAST "customer");
            xmlTextWriterWriteFormatElement(writer, BAD_CAST "nameCustomer", "%s", data->name);
            xmlTextWriterWriteFormatElement(writer, BAD_CAST "surnameCustomer", "%s", data->surname);
            xmlTextWriterWriteFormatElement(writer, BAD_CAST "emailCustomer", "%s", data->mail);
            xmlTextWriterStartElement(writer, BAD_CAST "booking");
            if(data->state == 1){
                xmlTextWriterStartElement(writer, BAD_CAST "entrance");
            }else{
                xmlTextWriterStartElement(writer, BAD_CAST "exit");
            }
                xmlTextWriterWriteFormatElement(writer, BAD_CAST "idBooking", "%s", data->idBooking);
                xmlTextWriterWriteFormatElement(writer, BAD_CAST "dateTime", "%s", data->datetime);
            xmlTextWriterEndElement(writer);
        xmlTextWriterEndElement(writer);
        xmlTextWriterEndElement(writer);
    }

    if(setFlag == 1){
        //</customers>
        xmlTextWriterEndElement(writer);
    }
    xmlFreeTextWriter(writer);

}

int readXMLFile(const char *fileName){

    int     error;
    xmlTextReaderPtr reader;
    reader = xmlReaderForFile(fileName, NULL, 0);
    if(reader == NULL){
        error = 1;
        printf("\nLe fichier n'existe pas!\n");
    }else{
        error = 0;
        printf("\nLe fichier existe!\n");
    }
    return error;

}


xmlDocPtr parseDoc(char *fileName, Data *data) {
    xmlDocPtr doc;
    xmlNodePtr cur;
    doc = xmlParseFile(fileName);
    if(doc == NULL) {
        fprintf(stderr,"Document not parsed successfully. \n");
        return (NULL);
    }
    cur = xmlDocGetRootElement(doc);
    if(cur == NULL) {
        fprintf(stderr,"empty document\n");
        xmlFreeDoc(doc);
        return (NULL);
    }
    printf("\ncurrentName = %s", cur->name);
    if(strcmp((char*)cur->name, (const xmlChar *) "customers") != 0) {
        fprintf(stderr,"document of the wrong type, root node != customers");
        xmlFreeDoc(doc);
        return (NULL);
    }else{
        printf("\nJe parse le fichier!\n");
        xmlNewTextChild(cur, NULL, "customer", NULL);

    }
    cur = cur->last;
    if(strcmp((char*)cur->name, (const xmlChar *) "customer") != 0) {
        fprintf(stderr,"document of the wrong type, root node != customer");
        xmlFreeDoc(doc);
        return (NULL);
    }else{

        printf("\nJe parse le fichier!\n");
        xmlNewTextChild(cur, NULL, "nameCustomer", data->name);
        xmlNewTextChild(cur, NULL, "surnameCustomer", data->surname);
        xmlNewTextChild(cur, NULL, "emailCustomer", data->mail);
        xmlNewTextChild(cur, NULL, "booking", NULL);
    }
    cur = cur->last;
    if(strcmp((char*)cur->name, (const xmlChar *) "booking") != 0) {
        fprintf(stderr,"document of the wrong type, root node != booking");
        xmlFreeDoc(doc);
        return (NULL);
    }else{

        printf("\nJe parse le fichier!\n");
        if(data->state == 1){
            xmlNewTextChild(cur, NULL, "exit", NULL);
        }else{
            xmlNewTextChild(cur, NULL, "entrance", NULL);
        }
        cur = cur->last;
        xmlNewTextChild(cur, NULL, "idBooking", data->idBooking);
        xmlNewTextChild(cur, NULL, "dateTime", data->datetime);

    }
    if(doc != NULL){

        xmlSaveFormatFile(fileName, doc, 0); //N'ECRASE PAS LE FICHIER LORS DE LA MODIFICATION
        xmlFreeDoc(doc);
    }

    return(doc);
}

void createDirectory(const char *fileName, Data *data){

    int     error;
    char    *mmyy = NULL;
    char    *path = "C:\\wamp64\\www\\Projet Annuel - Work'n Share\\Work-n-Share---Projet-Annuel\\Mission 1 - Gestion des clients\\Programmes C\\Gestion de fichiers XML\\Fusion des fichiers\\";
    const char    *directoryPath;


    mmyy = malloc(sizeof(char) * 4);
    directoryPath = malloc(sizeof(char) * (strlen(path) + strlen(mmyy)) + strlen(fileName));

    mmyy[2] = data->datetime[2];
    mmyy[3] = data->datetime[3];
    mmyy[0] = data->datetime[5];
    mmyy[1] = data->datetime[6];
    mmyy[4] = '\0';

    sprintf(directoryPath, "%s%s", path, mmyy);
    CreateDirectory(directoryPath, NULL);

    sprintf(directoryPath, "%s\\%s", directoryPath, fileName);
    printf("\npath: %s\n", directoryPath);

    error = readXMLFile(directoryPath);
    if(error == 1){
        xmlWriterFilename(directoryPath, data, error);
    }else{
        parseDoc(directoryPath, data);
        /*if(doc != NULL){
            xmlSaveFormatFile(directoryPath, doc, 0); //N'ECRASE PAS LE FICHIER LORS DE LA MODIFICATION
            xmlFreeDoc(doc);
        }*/
        free(data);
    }





    free(directoryPath);
    free(mmyy);

}
int checkHourBeforeSend(struct tm instant, time_t t){

    int     hour;
    int     minute;
    int     error = 0;
    time(&t);
    instant = *localtime(&t); //RECUPERE L'HEURE LOCALE

    hour = instant.tm_hour;
    minute = instant.tm_min;

    if(hour == 23 && minute == 0){ //SI 23:00
        printf("\nC'est l'heure d'envoyer les fichiers au service informatique!");
        error = 1;

    }else{
        printf("\nCe n'est pas l'heure d'envoyer les fichiers au service informatique!");
        error = 0;
    }
    return error;
}

void browseXMLFiles(){

    const char *directorypath = "C:\\wamp64\\www\\Projet Annuel - Work'n Share\\Work-n-Share---Projet-Annuel\\Mission 1 - Gestion des clients\\Programmes C\\Gestion de fichiers XML\\Fusion des fichiers";
    int length = 0;
    DIR* directory = NULL;
    struct dirent *readFile = NULL; //POINTEUR VERS LA STRUCTURE dirent
    directory = opendir(directorypath); //OUVERTURE DU DOSSIER CONTENANT LES FICHIERS XML

    if(directory == NULL){
        printf("\nLe dossier n'a pas pu s'ouvrir!\n");

    }else{
        printf("\nLe dossier est ouvert!\nJe vais lire les fichiers à l'intérieur!\n");
        while((readFile = readdir(directory)) != NULL){
            if(strstr(readFile->d_name, ".xml")){
                //TRAITEMENT ENVOI DES FICHIERS
                printf("%ld -> %s\n", telldir(directory), readFile->d_name);
                length = strlen(readFile->d_name);

            }
        }
    }


    if(closedir(directory) == -1){ //SI IL Y A UN SOUCIS AVEC LA FERMETURE
        exit(-1);
    }


    printf("\nLe dossier est fermé!\n");
}


void getElementContent(const char *fileName, Data *value){

    xmlDocPtr doc;
    xmlNodePtr cur;
    xmlNodePtr cur2;




    if(value == NULL){
        fprintf(stderr,"Allocation Impossible");
        exit(EXIT_FAILURE);
    }

    memset(value, 0, sizeof(Data));

    doc = xmlParseFile(fileName);
    cur = xmlDocGetRootElement(doc);
    cur = cur->xmlChildrenNode;

	while(cur != NULL){
		if((!xmlStrcmp(cur->name, (const xmlChar *)"customer"))){
            parseFile(doc, cur, value);
		}
        cur = cur->next;
	}


}


void parseFile(xmlDocPtr doc, xmlNodePtr cur, Data *value){


	cur = cur->xmlChildrenNode;
	while (cur != NULL) {
	    if ((!xmlStrcmp(cur->name, (const xmlChar *)"nameCustomer"))) {
		    value->name = xmlNodeListGetString(doc, cur->xmlChildrenNode, 1);
		    printf("name: %s\n", value->name);
 	    }
 	    if ((!xmlStrcmp(cur->name, (const xmlChar *)"surnameCustomer"))) {
		    value->surname = xmlNodeListGetString(doc, cur->xmlChildrenNode, 1);
		    printf("surname: %s\n", value->surname);
 	    }
 	    if ((!xmlStrcmp(cur->name, (const xmlChar *)"emailCustomer"))) {
		    value->mail = xmlNodeListGetString(doc, cur->xmlChildrenNode, 1);
		    printf("email: %s\n", value->mail);
 	    }
 	    if ((!xmlStrcmp(cur->name, (const xmlChar *)"booking"))) {
		    cur = cur->xmlChildrenNode;
		    if ((!xmlStrcmp(cur->name, (const xmlChar *)"entrance"))) {
                cur = cur->xmlChildrenNode;
		    }
 	    }

 	    if ((!xmlStrcmp(cur->name, (const xmlChar *)"idBooking"))) {
		    value->idBooking = xmlNodeListGetString(doc, cur->xmlChildrenNode, 1);
		    printf("idBooking: %s\n", value->idBooking);
 	    }
 	    if ((!xmlStrcmp(cur->name, (const xmlChar *)"dateTime"))) {
		    value->datetime = xmlNodeListGetString(doc, cur->xmlChildrenNode, 1);
		    printf("date: %s\n", value->datetime);
 	    }
            printf("cur_name: %s\n", cur->name);
		    cur = cur->next;
	}

}
