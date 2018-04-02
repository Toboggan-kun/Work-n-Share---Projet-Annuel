#include <gtk/gtk.h>
#include <stdlib.h>
#include <string.h>
#include <stdio.h>
#include <winsock.h>
#include <mysql.h>
#include <winsock2.h>

#include "header.h"
void messageError(int type){

  GtkWidget *dialog;
  GtkWidget *window;
  window = gtk_window_new(GTK_WINDOW_POPUP);

  dialog = gtk_message_dialog_new(GTK_WINDOW(window), GTK_DIALOG_MODAL | GTK_DIALOG_DESTROY_WITH_PARENT, GTK_MESSAGE_ERROR, GTK_BUTTONS_OK, "Erreur\n");
  if(type == 0){
    gtk_message_dialog_format_secondary_text (GTK_MESSAGE_DIALOG (dialog), "Veuillez saisir un identifiant.");
  }else if(type == 1){
    gtk_message_dialog_format_secondary_text (GTK_MESSAGE_DIALOG (dialog), "Cet utilisateur n'existe pas.");
  }else if(type == 2){
    gtk_message_dialog_format_secondary_text (GTK_MESSAGE_DIALOG (dialog), "La réservation de cet utilisateur est invalide.\nVeuillez vérifier la validité de sa réservation.");
  }else if(type == 3){
    gtk_message_dialog_format_secondary_text (GTK_MESSAGE_DIALOG (dialog), "Cet utilisateur ne possède pas de réservation.");
  }else if(type == 4){
    gtk_message_dialog_format_secondary_text (GTK_MESSAGE_DIALOG (dialog), "Un QrCode lié à cet utilisateur a déjà été créé.");
  }

  gtk_dialog_run(GTK_DIALOG(dialog));
  gtk_widget_destroy (dialog);

}

void messageSuccess(int type){

  GtkWidget *dialog;
  GtkWidget *window;
  window = gtk_window_new(GTK_WINDOW_POPUP);

  dialog = gtk_message_dialog_new(GTK_WINDOW(window), GTK_DIALOG_MODAL | GTK_DIALOG_DESTROY_WITH_PARENT, GTK_MESSAGE_OTHER, GTK_BUTTONS_OK, "Demande terminée\n");
  gtk_message_dialog_format_secondary_text (GTK_MESSAGE_DIALOG (dialog), "Un QrCode a bien été généré.");
  gtk_dialog_run(GTK_DIALOG(dialog));
  gtk_widget_destroy (dialog);

}
