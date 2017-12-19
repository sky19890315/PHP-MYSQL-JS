from tkinter import *


class App(Frame):
    def __init__(self, master=NONE):
        super().__init__(master)
        self.pack()

        self.entrythingy = Entry()
        self.entrythingy.pack()

        self.contents = StringVar()
        self.contents.set('this is a varaible')
        self.entrythingy['textvariable'] = self.contents

        self.entrythingy.bind('<Key-Return>', self.print_contents)

        def print_contents(self, event):
            print('hi contents of entry is now------->', self.contents.get())


app = App()
app.mainloop()