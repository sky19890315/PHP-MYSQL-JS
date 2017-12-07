from tkinter import *
import tkinter.messagebox as messagebox


class Application(Frame):
    def __init__(self, master=None):
        Frame.__init__(self, master)
        self.pack()
        self.createWidgets()

    def createWidgets(self):
        self.nameInput = Entry(self)
        # self.helloLabel = Label(self, text='Hello, world!')
        self.nameInput.pack()
        self.alertButton = Button(self, text='Fuck', command=self.hello)
        self.alertButton.pack()

    def hello(self):
        name = self.nameInput.get() or 'you!'
        messagebox.showinfo('Message', 'Fuck, %s' % name)


app = Application()
app.master.title('Fuck, you!')
app.mainloop()





































