typedef struct Data{
    char    idUser[2];
    char    name[25];
    char    surname[25];
    char    mail[50];
    char    datetime[21];
    char    idBooking[2];
    int     idOpenspace[2];
    char    openspaceName[15];
}Data;

void addXmlExtension(char *arrayName, int arrayLenght);
void xmlWriterFilename(const char *uri, struct Data data);
void addXmlExtension(char *arrayName, int arrayLenght);
//void createDirectory(struct Data data);
