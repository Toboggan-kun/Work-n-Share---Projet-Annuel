#include <gtk/gtk.h>
#include <stdlib.h>
#include <string.h>
#include <stdio.h>
#include <winsock.h>
#include <mysql.h>
#include <winsock2.h>
#include <time.h>
void messageError(int type);
void messageSuccess(int type);
void createTitle(const gchar *title, GtkBox *box);
void createText(const gchar* text, GtkBox *box);
void createButton(const gchar* buttonName, GtkTable *form, GtkEntry *entry);

void getValue(GtkWidget *widget, gpointer data);
void checkDateTime(struct tm instant, time_t t, char otherDate);

//HEURE
time_t t;
struct tm instant;
