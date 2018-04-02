
#include "header.h"

int main(int argc, char ** argv){
    //HEURE
    time_t t;
    struct tm instant;

    GtkWidget *window; //FENETRE
    GtkWidget *vBox; //BOX

    //INITIALIZATION OF GTK
    gtk_init(&argc,&argv);

    //CREATION DE LA FENETRE
    window = gtk_window_new(GTK_WINDOW_TOPLEVEL);
    gtk_window_set_title(GTK_WINDOW(window), "WORK'N SHARE - QRCODE");
    gtk_window_set_default_size(GTK_WINDOW(window), 500, 600);
    g_signal_connect(G_OBJECT(window), "destroy", G_CALLBACK(gtk_main_quit), NULL);

    //CREATION D'UNE VERTICAL BOX
    vBox = gtk_vbox_new(TRUE, 0);
    gtk_container_add(GTK_CONTAINER(window), vBox);

    createTitle("\n\n<b><big>Work'n Share\nBienvenue sur l'interface\nGeneration de QrCode</big></b>\n\n", vBox);
    createText("Veuillez indiquer l'identifiant de l'utilisateur.\n\nMerci de vérifier que:"
               "\n\t1/ L'utilisateur existe"
               "\n\t2/ Si cet utilisateur possède bien une réservation valide (non expirée)", vBox);
    createForm(4, 4, "Identifiant de l'utilisateur: ", vBox);

    checkDateTime();

    gtk_widget_show_all(window);

    gtk_main();

    return 0;
}
