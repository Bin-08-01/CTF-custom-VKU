#include<stdio.h>

int main(){
    FILE *file;
    char buf[32];
    int authentication = 0;
    char flag[100];

    printf("Enter the username : \n");
    fflush(stdout);

    gets(buf);
    if(authentication){
        printf("Welcome back, admin!!!\n");
        printf("Here is your flag: ");
        fflush(stdout);

        file = fopen("flag.txt", "r");
        if (file == NULL)
        {
            printf("Cannot open file 'flag.txt'\n");
            fflush(stdout);
            return 1;
        }
        fgets(flag, 100, file);
        puts(flag);
    }else{
        printf("You are not admin, get out of here!!!\n");
        fflush(stdout);
    }
}