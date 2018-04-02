

#include "header.h"

void createTitle(const gchar *title, GtkBox *box){
    GtkWidget *headerTitleLabel;
    gchar *headerTitle;

    //INSERTION D'UN TITRE DANS LA VERTICAL BOX
    headerTitle = g_locale_from_utf8(title, -1, NULL, NULL, NULL);
    headerTitleLabel = gtk_label_new(headerTitle);
    gtk_label_set_use_markup(GTK_LABEL(headerTitleLabel), TRUE);
    gtk_label_set_justify(GTK_LABEL(headerTitleLabel), GTK_JUSTIFY_CENTER);
    gtk_box_pack_start(GTK_BOX(box), headerTitleLabel, TRUE, FALSE, 0);

}

void createForm(guint rows, guint cols, const gchar* name, GtkBox *box){
    GtkWidget *formArray;
    GtkWidget *label;
    GtkWidget *formInput;
    GtkWidget *button;


    formArray = gtk_table_new(rows, cols, TRUE);
    gtk_box_pack_start(GTK_BOX(box), formArray, FALSE, TRUE, 10);

    //NAME
    label = gtk_label_new(name);
    formInput = gtk_entry_new();

    gtk_table_attach(GTK_TABLE(formArray), label, 1, 2, 0, 1, !GTK_EXPAND | !GTK_FILL, !GTK_EXPAND, 0, 0);
    gtk_table_attach(GTK_TABLE(formArray), formInput, 2, 3, 0, 1, !GTK_EXPAND | !GTK_FILL, !GTK_EXPAND, 10, 15);

    button = gtk_button_new_with_label("Valider");
    gtk_table_attach(GTK_TABLE(formArray), button, 1, 3, 0, 4, !GTK_EXPAND | !GTK_FILL, !GTK_EXPAND, 0, 0);
    g_signal_connect(button, "clicked", G_CALLBACK(getValue), formInput);

}

void createButton(const gchar* buttonName, GtkTable *form, GtkEntry *formInput){

    GtkWidget *button;
    button = gtk_button_new_with_label(buttonName);
    gtk_table_attach(GTK_TABLE(form), button, 2, 3, 0, 4, !GTK_EXPAND | !GTK_FILL, !GTK_EXPAND, 0, 0);

}
void createText(const gchar* text, GtkBox *box){

    GtkWidget *textLabel;
    textLabel = gtk_label_new(text);
    gtk_box_pack_start(GTK_BOX(box), textLabel, TRUE, TRUE, 0);
}
