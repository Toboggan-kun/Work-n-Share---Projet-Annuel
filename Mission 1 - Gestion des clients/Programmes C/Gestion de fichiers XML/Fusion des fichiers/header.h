typedef struct Data{
    xmlChar    *idUser;
    xmlChar    *name;
    xmlChar    *surname;
    xmlChar    *mail;
    xmlChar    *datetime;
    xmlChar    *idBooking;
    xmlChar    *idOpenspace;
    xmlChar    *openspaceName;
    xmlChar    *state;
}Data;

void addXmlExtension(char *arrayName, int arrayLenght);
void xmlWriterFilename(const char *uri, Data *data, int setFlag);
void addXmlExtension(char *arrayName, int arrayLenght);
int readXMLFile(const char *fileName);
xmlDocPtr parseDoc(char *fileName, Data *data);
void createDirectory(const char *fileName, Data *data);
int checkHourBeforeSend(struct tm instant, time_t t);
void browseXMLFiles();
void getElementContent(const char *fileName, Data *value);
void parseFile(xmlDocPtr doc, xmlNodePtr cur, Data *value);
