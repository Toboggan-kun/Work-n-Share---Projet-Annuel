#include <stdio.h>
#include <stdlib.h>
#include <winsock2.h>
#include <mysql.h>
#include <libxml/encoding.h>
#include <libxml/xmlwriter.h>
#include <libxml/xmlreader.h>
#include <libxml/parser.h>
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
        xmlTextWriterStartElement(writer, BAD_CAST "application");
            xmlTextWriterWriteFormatElement(writer, BAD_CAST "name", "%s", "Work'n Share");
            xmlTextWriterWriteFormatElement(writer, BAD_CAST "version", "%s", "1.0");
        xmlTextWriterEndElement(writer);
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

    if(setFlag == 1){
        //</customers>
        xmlTextWriterEndElement(writer);
    }
    xmlFreeTextWriter(writer);

}

void getContent(xmlNode* root, struct Data data){
    xmlNode* current = NULL;
    current = root;
    //char *arrayData[][];

    /*sprintf(data.name, "%s", (const char*)xmlNodeGetContent(current));
    sprintf(data.surname, "%s", (const char*)xmlNodeGetContent(current));
    sprintf(data.mail, "%s", (const char*)xmlNodeGetContent(current));
    sprintf(data.datetime, "%s", (const char*)xmlNodeGetContent(current));
    sprintf(data.idBooking, "%s", (const char*)xmlNodeGetContent(current));
    sprintf(data.idOpenspace, "%s", (const char*)xmlNodeGetContent(current));
    sprintf(data.openspaceName, "%s", (const char*)xmlNodeGetContent(current));*/

    printf("\n%s %s %s %s %s %s %s\n", data.name, data.surname, data.mail, data.datetime, data.idBooking, data.idOpenspace, data.openspaceName);
    for(current = root; current != NULL; current = current->next){
        if(current->type == XML_ELEMENT_NODE)
            printf( "node type: %s\n", current->name );
        if(strcmp((char*)current->name, (char*)current->name) == 0){
            printf( "%s\n", (const char*)xmlNodeGetContent(current));
        }
    }
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

void createFinalXMLFile(const char *uri, struct Data data){

    const char          *xmlFinalFileName;
    xmlTextReaderPtr    reader;
    xmlTextWriterPtr    writer;
    writer = xmlNewTextWriterFilename(uri, 0);

    reader = xmlReaderForFile(uri, NULL, 0);
    if(reader == NULL){
        printf("\nCe fichier XML n'existe pas! Je peux donc créer un nouveau fichier");
        char jj[2];
        jj[0] = data.datetime[8];
        jj[1] = data.datetime[9];
        jj[2] = '\0';
        printf("JJ = %s", jj);
        sprintf(xmlFinalFileName, "%s.xml", jj);
        xmlWriterFilename(xmlFinalFileName, data, 1);
    }else{
        printf("\nCe fichier XML existe! Je ne peux pas créer un nouveau fichier");
    }

}

/*void createDirectory(struct Data data){
    int     i = 0;
    int     length = 0;
    char    mmyy[4];
    char    *directoryPath;

    length = strlen(data.datetime);
    mmyy[2] = data.datetime[2];
    mmyy[3] = data.datetime[3];
    mmyy[0] = data.datetime[5];
    mmyy[1] = data.datetime[6];
    //system("md %s", mmyy);
    CreateDirectory(("C:\\wamp64\\www\\Projet Annuel - Work'n Share\\Gestion fichiers XML\\xmlFiles\\" + mmyy), NULL);
} //A REVOIR APRES L'ENVOI DU FICHIER VIA SOCKET FTP*/

