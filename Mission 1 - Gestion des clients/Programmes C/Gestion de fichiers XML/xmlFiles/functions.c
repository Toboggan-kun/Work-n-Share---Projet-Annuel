#include <stdio.h>
#include <stdlib.h>
#include <winsock.h>
#include <mysql.h>
#include <winsock2.h>
#include <libxml/xmlwriter.h>
#include <libxml/tree.h>
#include "header.h"

void xmlWriterFilename(const char *uri, struct Data data){

    xmlTextWriterPtr    writer;

    writer = xmlNewTextWriterFilename(uri, 0);
    if(writer == NULL) {
        printf("xmlWriterFilename: Error creating the xml writer\n");
        return;
    }

    xmlTextWriterStartDocument(writer, NULL, "UTF-8", NULL);

    xmlTextWriterStartElement(writer, BAD_CAST "application");
        xmlTextWriterWriteFormatElement(writer, BAD_CAST "name", "%s", "Work'n Share");
        xmlTextWriterWriteFormatElement(writer, BAD_CAST "version", "%s", "1.0");
    xmlTextWriterEndElement(writer);

    xmlTextWriterStartElement(writer, BAD_CAST "customer");
        xmlTextWriterWriteFormatElement(writer, BAD_CAST "nameCustomer", "%s", data.name);
        xmlTextWriterWriteFormatElement(writer, BAD_CAST "surnameCustomer", "%s", data.surname);
        xmlTextWriterWriteFormatElement(writer, BAD_CAST "emailCustomer", "%s", data.mail);
    xmlTextWriterEndElement(writer);

    xmlTextWriterStartElement(writer, BAD_CAST "booking");
    if(data.idBooking == 1){
        xmlTextWriterStartElement(writer, BAD_CAST "entrance");
    }else{
        xmlTextWriterStartElement(writer, BAD_CAST "exit");
    }
        xmlTextWriterWriteFormatElement(writer, BAD_CAST "idBooking", "%s", data.idBooking);
        xmlTextWriterWriteFormatElement(writer, BAD_CAST "dateTime", "%s", data.datetime);
    xmlTextWriterEndElement(writer);

    xmlFreeTextWriter(writer);

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

