typedef struct Data{
    char    idUser[2];
    char    name[25];
    char    surname[25];
    char    mail[50];
    char    datetime[21];
    char    idBooking[2];
    int     idOpenspace[2];
    char    openspaceName[15];
    int     state[1];
}Data;

void addXmlExtension(char *arrayName, int arrayLenght);
void xmlWriterFilename(const char *uri, struct Data data, int setFlag);
void addXmlExtension(char *arrayName, int arrayLenght);
int readXMLFile(const char *fileName);
xmlDocPtr parseDoc(char *fileName, struct Data data);
void createDirectory(const char *fileName, struct Data data);
int checkHourBeforeSend(struct tm instant, time_t t);
void browseXMLFiles();

