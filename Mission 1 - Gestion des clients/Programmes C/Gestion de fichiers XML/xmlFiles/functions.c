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

void xmlWriterFilename(const char *uri, struct Data data, int setFlag){

    xmlTextWriterPtr    writer;

    writer = xmlNewTextWriterFilename(uri, 0);
    if(writer == NULL) {
        printf("xmlWriterFilename: Error creating the xml writer\n");
        return;
    }

    xmlTextWriterStartDocument(writer, NULL, "UTF-8", NULL);

    if(setFlag == 1){
        xmlTextWriterStartElement(writer, BAD_CAST "customers");
    }
    xmlTextWriterStartElement(writer, BAD_CAST "customer");
        xmlTextWriterWriteFormatElement(writer, BAD_CAST "nameCustomer", "%s", data.name);
        xmlTextWriterWriteFormatElement(writer, BAD_CAST "surnameCustomer", "%s", data.surname);
        xmlTextWriterWriteFormatElement(writer, BAD_CAST "emailCustomer", "%s", data.mail);
        xmlTextWriterStartElement(writer, BAD_CAST "booking");
        if(data.idBooking == 1){
            xmlTextWriterStartElement(writer, BAD_CAST "entrance");
        }else{
            xmlTextWriterStartElement(writer, BAD_CAST "exit");
        }
            xmlTextWriterWriteFormatElement(writer, BAD_CAST "idBooking", "%s", data.idBooking);
            xmlTextWriterWriteFormatElement(writer, BAD_CAST "dateTime", "%s", data.datetime);
        xmlTextWriterEndElement(writer);
    xmlTextWriterEndElement(writer);
    xmlTextWriterEndElement(writer);
    if(setFlag == 1){
        //</customers>
        xmlTextWriterEndElement(writer);
    }
    xmlFreeTextWriter(writer);

}

void readXMLFile(const char *fileName){

    xmlTextReaderPtr reader;
    const xmlChar *name, *value;
    reader = xmlReaderForFile(fileName, NULL, 0);
    if(reader == NULL){
        printf("\nCe fichier XML n'existe pas!");
    }else{
        printf("\nCe fichier XML existe!");
    }

}


xmlDocPtr parseDoc(char *fileName, struct Data data) {
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
        xmlNewTextChild(cur, NULL, "nameCustomer", data.name);
        xmlNewTextChild(cur, NULL, "surnameCustomer", data.surname);
        xmlNewTextChild(cur, NULL, "emailCustomer", data.mail);
        xmlNewTextChild(cur, NULL, "booking", NULL);
    }
    cur = cur->last;
    if(strcmp((char*)cur->name, (const xmlChar *) "booking") != 0) {
        fprintf(stderr,"document of the wrong type, root node != booking");
        xmlFreeDoc(doc);
        return (NULL);
    }else{

        printf("\nJe parse le fichier!\n");
        if(data.idBooking == 1){
            xmlNewTextChild(cur, NULL, "exit", NULL);
        }else{
            xmlNewTextChild(cur, NULL, "entrance", NULL);
        }
        cur = cur->last;
        xmlNewTextChild(cur, NULL, "idBooking", data.idBooking);
        xmlNewTextChild(cur, NULL, "dateTime", data.datetime);

    }

    return(doc);
}

void createDirectory(struct Data data){
    int     i = 0;
    int     length = 0;
    int     length2 = 0;
    char    *mmyy = NULL;
    char    *path = "C:\\wamp64\\www\\Projet Annuel - Work'n Share\\Gestion fichiers XML\\xmlFiles\\";
    char    *directoryPath;

    mmyy = malloc(sizeof(char) * 4);
    directoryPath = malloc(sizeof(char) * (strlen(path) + strlen(mmyy)));

    mmyy[2] = data.datetime[2];
    mmyy[3] = data.datetime[3];
    mmyy[0] = data.datetime[5];
    mmyy[1] = data.datetime[6];
    mmyy[4] = '\0';

    sprintf(directoryPath, "%s%s", path, mmyy);

    CreateDirectory(directoryPath, NULL);
    free(directoryPath);
    free(mmyy);
}

