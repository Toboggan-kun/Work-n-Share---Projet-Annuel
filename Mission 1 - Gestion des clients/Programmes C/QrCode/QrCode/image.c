#include <stdio.h>
#include <string.h>
#include <stdio.h>
#include <stdlib.h>
#include <qrencode.h>
#include <opencv2/core/core.hpp>
#include <opencv2/highgui/highgui.hpp>
 
#include "qrcode/main.c"
 
const char * help = "Usage: ./generator (-jpg|-png) content";
 
int main(int argc, char * argv [])
{
    unsigned int        width, x, y, l, n, realWidth, bmpSize;
    unsigned char   *   pRGBData = NULL;
    unsigned char   *   pSourceData = NULL;
    unsigned char   *   pDestData = NULL;
    QRcode*             pQRC = NULL;
    FILE*               fp = NULL;
    int convert = 0;
 
    if (argc >= 3)
    {
        if (strcmp(argv[1],"-png") == 0){
            convert = OPT_CONVERT_PNG;
        }
        else if (strcmp(argv[1],"-jpg") == 0){
            convert = OPT_CONVERT_JPG;
        }
        else {
            printf("Unknown conversion option. Use -png or -jpg.\n");
            exit(-1);
        }
    }
 
    char cmd [1024];
 
    char codeInput[1024];
    char fileName[1024];
    char fileNamePNG[1024];
    char fileNameJPG[1024];
 
    if (argv[1] == NULL) {
        printf("Error, no input content.\n");
        exit(-1);
    } else if (strcmp(argv[1],"--help") == 0){
        printf("%s\n",help);
        exit(-1);
    }
 
    strcpy(codeInput, argc >= 3 ? argv[2] : argv[1]);
 
    strcpy(fileName, codeInput);
    strcpy(fileNamePNG, codeInput);
    strcpy(fileNameJPG, codeInput);
 
    strcat(fileName, ".bmp");
    strcat(fileNamePNG, ".png");
    strcat(fileNameJPG, ".jpg");
 
    strcpy(cmd,"rm ");
    strcat(cmd,fileName);
 
    pQRC = QRcode_encodeString(codeInput, 0, QR_ECLEVEL_H, QR_MODE_8, 1); // encodage de l'input en QRCode
 
    if (pQRC == NULL) {
        printf("Error while encoding '%s' as a QRCode.\n",codeInput);
        exit(-1);
    }
 
    width = pQRC->width; // largeur requise par le qrcode généré
    realWidth = width * OUT_FILE_PIXEL_PRESCALER * 3; // pour la taille réelle du QRCode. on multiplie par notre prescaler,
                                                      // puis par 3 (car 3 bits par pixel pour la couleur)
    if (realWidth % 4 != 0)
        realWidth = (realWidth / 4 + 1) * 4; // re ajustement de la taille réelle (si ce n'est pas un multiple de 2)
    bmpSize = realWidth * realWidth; // calcul de la taille totale de l'image
 
    pRGBData = (unsigned char*)malloc(sizeof(unsigned char) * bmpSize); // allocation mémoire de la taille de l'image pour travailler dessus.
 
    if (pRGBData == NULL) {
        printf("Error while allocating memory.\n");
        QRcode_free(pQRC);
        exit(-1);
    }
 
    memset(pRGBData, 0xff, bmpSize); // on place tous les pixels en blanc.
 
    BITMAPFILEHEADER kFileHeader;
    BITMAPINFOHEADER kInfoHeader;
 
    fillHeaders(&kFileHeader, &kInfoHeader, bmpSize, width);
 
    pSourceData = pQRC->data;
    for (y = 0; y < width; y++) // pour chaque ligne de pixels.
    {
        pDestData = pRGBData + realWidth * y * OUT_FILE_PIXEL_PRESCALER;
        for (x = 0; x < width; x++) // pour chaque octet du QRCode encodé.
        {
            if (*pSourceData & 1)
            {
                for (l = 0; l < OUT_FILE_PIXEL_PRESCALER; l++) // l = axe vertical
                {
                    for (n = 0; n < OUT_FILE_PIXEL_PRESCALER; n++) // n = axe horizontal
                    {
                        *(pDestData   +   n * 3 + realWidth * l) = 0x00;
                        *(pDestData + 1 + n * 3 + realWidth * l) = 0x00;
                        *(pDestData + 2 + n * 3 + realWidth * l) = 0x00;
                    }
                }
            }
            pDestData += 3 * OUT_FILE_PIXEL_PRESCALER;
            pSourceData++;
        }
    }
 
    fp = fopen(fileName, "wb");
 
    if (fp == NULL){
        printf("Error while opening the output file.\n");
        QRcode_free(pQRC);
        free(pRGBData);
        exit(-1);
    }
 
    fwrite(&kFileHeader, sizeof(BITMAPFILEHEADER), 1, fp);
    fwrite(&kInfoHeader, sizeof(BITMAPINFOHEADER), 1, fp);
    fwrite(pRGBData, sizeof(unsigned char), bmpSize, fp);
    fclose(fp);
 
    if (convert){
        IplImage* finalImage = cvLoadImage(fileName,1);
        if (finalImage == NULL){
            printf("Error while converting the image\n");
            QRcode_free(pQRC);
            free(pRGBData);
            exit(-1);
        }
        if      (convert == OPT_CONVERT_PNG)
            cvSaveImage(fileNamePNG, finalImage,0);
        else if (convert == OPT_CONVERT_JPG)
            cvSaveImage(fileNameJPG, finalImage,0);
        cvReleaseImage(&finalImage);
        system(cmd);
    }
    QRcode_free(pQRC);
    free(pRGBData);
    printf("Successfully created QRCode with value '%s'.\n",codeInput);
    exit(0);
}
 
void fillHeaders(BITMAPFILEHEADER * fileHeader, BITMAPINFOHEADER * infoHeader, long bmpSize, long width) {
 
    fileHeader->bfType = 0x4d42;  // "BM"
    fileHeader->bfSize = sizeof(BITMAPFILEHEADER) + sizeof(BITMAPINFOHEADER) + bmpSize;
    fileHeader->bfReserved1 = 0;
    fileHeader->bfReserved2 = 0;
    fileHeader->bfOffBits = sizeof(BITMAPFILEHEADER) + sizeof(BITMAPINFOHEADER);
 
    infoHeader->biSize = sizeof(BITMAPINFOHEADER);
    infoHeader->biWidth = width * OUT_FILE_PIXEL_PRESCALER;
    infoHeader->biHeight = -(width * OUT_FILE_PIXEL_PRESCALER);
    infoHeader->biPlanes = 1;
    infoHeader->biBitCount = 24;
    infoHeader->biCompression = BI_RGB;
    infoHeader->biSizeImage = 0;
    infoHeader->biXPelsPerMeter = 0;
    infoHeader->biYPelsPerMeter = 0;
    infoHeader->biClrUsed = 0;
    infoHeader->biClrImportant = 0;
}